<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $attendances = Attendance::orderBy('date', 'desc')->where('user_id', Auth::id());

        $attendances = $attendances->paginate()->withQueryString();

        return view('my-attendances.index', compact('attendances'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();

        switch ($request->type) {
            case 'attend':
                @list($type, $file_data) = explode(';', $request->foto);
                @list(, $file_data) = explode(',', $file_data);
                $imageName = 'absensi/' . $user_id . time() . '.' . 'png';

                Storage::put($imageName, base64_decode($file_data));

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
                # code...
                break;
        }

        return redirect()->back()->with('alert-success', 'Berhasil menambah data.');
    }
}
