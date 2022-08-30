<?php

namespace App\Http\Controllers;

use App\Attendance;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $attendances = Attendance::orderBy('date', 'desc')->latest()
            ->where('user_id', Auth::id());

        if ($request->type) {
            $attendances->where('type', $request->type);
        }

        $attendances = $attendances->paginate()->withQueryString();

        return view('my-attendances.index', compact('attendances'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $user = Auth::user();

        switch ($request->type) {
            case 'attend':
                @list($type, $file_data) = explode(';', $request->foto);
                @list(, $file_data) = explode(',', $file_data);
                $imageName = 'absensi/' . $user_id . time() . '.' . 'png';

                Storage::put($imageName, base64_decode($file_data));

                Attendance::where('date', date('Y-m-d'))
                    ->where('user_id', $user_id)
                    ->update([
                        'status' => 'rejected'
                    ]);

                $attendance = new Attendance();
                $attendance->user_id = $user_id;
                $attendance->type = $request->type;
                $attendance->file = $imageName;
                $attendance->date = date('Y-m-d');
                $attendance->time_in = date('H:i');
                $attendance->status = 'approved';
                $attendance->save();
                break;


            default:
                $start_date = Carbon::parse($request->start_date);
                $end_date = Carbon::parse($request->end_date);
                $period = CarbonPeriod::create($start_date, $end_date);

                $totalDay = count($period);
                $joinAt = Carbon::parse($user->joined_at)->year(date('Y'));
                if ($joinAt > now()) {
                    $joinAt = Carbon::parse($user->joined_at)->year(date('Y') - 1);
                }

                $totalPaidLeave = Attendance::where('user_id', $user->id)
                    ->where('status', '!=', 'rejected')
                    ->where('type', 'paid_leave')
                    ->where('date', '>=', $joinAt)
                    ->count();

                $remainingPaidLeave = 12 - $totalPaidLeave;
                if ($totalDay > $remainingPaidLeave && $request->type == 'paid_leave') {
                    return redirect()->back()->with('alert-error', 'Jumlah pengajuan melebihi sisa cuti');
                }

                Attendance::where('date', '>=', $request->start_date)
                    ->where('date', '<=', $request->end_date)
                    ->where('user_id', $user_id)
                    ->update([
                        'status' => 'rejected'
                    ]);

                if ($request->type == 'sick') {
                    $file = Storage::putFile('absensi', $request->file('file'));
                }

                foreach ($period as $date) {
                    $attendance = new Attendance();
                    if ($request->type == 'sick') {
                        $attendance->file = $file;
                    }
                    $attendance->user_id = $user_id;
                    $attendance->type = $request->type;
                    $attendance->date = $date->format('Y-m-d');
                    $attendance->time_in = date('H:i');
                    $attendance->status = 'pending';
                    $attendance->save();
                }
                break;
        }

        return redirect()->back()->with('alert-success', 'Berhasil menambah data.');
    }
}
