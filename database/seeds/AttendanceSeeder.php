<?php

namespace Database\Seeders;

use App\Attendance;
use App\User;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $period = CarbonPeriod::create(now()->subMonth()->startOfMonth(), now());
        $employees = User::all();
        $employees->each(function ($employee) use ($period) {
            foreach ($period as $date) {
                $attendance = new Attendance;
                $attendance->user_id = $employee->id;
                $attendance->date = $date;
                $attendance->time_in = $date->hour(8)->addMinutes(rand(50, 70));
                $attendance->status = 'approved';
                $attendance->type = ['present', 'off'][rand(0, 1)];
                $attendance->description = '';
                $attendance->save();
            }
        });
    }
}
