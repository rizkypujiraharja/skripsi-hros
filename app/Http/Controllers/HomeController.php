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
            ->where('type', 'not_present')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->count();

        $total = [
            'remain_paid_leave' => $remainingPaidLeave,
            'sick' => $totalSick,
            'permission' => $totalPermission,
            'not_present' => $totalNotPresent,
        ];

        return view('index', compact('user', 'total'));
    }
}
