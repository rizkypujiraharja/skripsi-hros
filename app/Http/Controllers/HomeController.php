<?php

namespace App\Http\Controllers;

use App\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $joinAt = Carbon::parse($user->joined_at)->year(date('Y'));
        if ($joinAt > now()) {
            $joinAt = Carbon::parse($user->joined_at)->year(date('Y') - 1);
        }

        $totalPaidLeave = Attendance::where('user_id', $user->id)
            ->where('status', '!=', 'rejected')
            ->where('type', 'paid_leave')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->count();

        $remainingPaidLeave = 12 - $totalPaidLeave;

        $totalSick = Attendance::where('user_id', $user->id)
            ->where('status', '!=', 'rejected')
            ->where('type', 'sick')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->count();

        $totalPermission = Attendance::where('user_id', $user->id)
            ->where('status', '!=', 'rejected')
            ->where('type', 'permission')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->count();

        $totalNotPresent = Attendance::where('user_id', $user->id)
            ->where('type', 'net_attend')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->count();

        $total = [
            'remain_paid_leave' => $remainingPaidLeave,
            'sick' => $totalSick,
            'permission' => $totalPermission,
            'not_present' => $totalNotPresent,
        ];

        $period = $joinAt->format('Y-m-d') . ' s/d ' . date('Y-m-d');

        $stats = [];
        $stats[] = Attendance::where('user_id', $user->id)
            ->where('type', 'attend')
            ->where('status', 'approved')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->count();

        $stats[] = Attendance::where('user_id', $user->id)
            ->where('type', 'attend')
            ->where('status', 'approved')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->where('time_in', '>', '08:30')
            ->where('time_in', '<=', '08:45')
            ->count();

        $stats[] = Attendance::where('user_id', $user->id)
            ->where('type', 'attend')
            ->where('status', 'approved')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->where('time_in', '>', '08:45')
            ->where('time_in', '<=', '09:00')
            ->count();

        $stats[] = Attendance::where('user_id', $user->id)
            ->where('type', 'attend')
            ->where('status', 'approved')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->where('time_in', '>', '09:00')
            ->where('time_in', '<=', '09:15')
            ->count();

        $stats[] = Attendance::where('user_id', $user->id)
            ->where('type', 'attend')
            ->where('status', 'approved')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->where('time_in', '>', '09:15')
            ->where('time_in', '<=', '09:30')
            ->count();


        $stats[] = Attendance::where('user_id', $user->id)
            ->where('type', 'attend')
            ->where('status', 'approved')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->where('time_in', '>', '09:30')
            ->count();

        return view('index', compact('user', 'total', 'period', 'stats'));
    }
}
