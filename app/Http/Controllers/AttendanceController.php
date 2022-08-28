<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $attendances = Attendance::with('user')->latest();

        if ($request->type) {
            $attendances->where('type', $request->type);
        }

        $attendances = $attendances->paginate()->withQueryString();

        return view('attendances.index', compact('attendances'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $attendance->status = $request->status;
        $attendance->save();

        return redirect()->back()->with('alert-success', 'Data kehadiran berhasil diupdate!');
    }

    public function processNotPresent()
    {
        $users = User::whereDoesntHave('attendances', function (Builder $query) {
            $query->where('date', date('Y-m-d'))->where('status', 'approved');
        })->get();

        foreach ($users as $user) {
            $attendance = new Attendance();
            $attendance->user_id = $user->id;
            $attendance->type = 'not_attend';
            $attendance->date = date('Y-m-d');
            $attendance->status = 'approved';
            $attendance->save();
        }

        return redirect()->back()->with('alert-success', 'Berhasil memproses data ketidakhadiran');
    }
}
