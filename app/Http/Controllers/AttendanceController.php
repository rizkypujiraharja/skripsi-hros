<?php

namespace App\Http\Controllers;

use App\Attendance;
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
}
