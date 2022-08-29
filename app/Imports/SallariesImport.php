<?php

namespace App\Imports;

use App\Sallary;
use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SallariesImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $month = date('m');
        $year = date('Y');

        foreach ($rows as $index => $row) {
            if ($index) {
                $user = User::find($row[0]);
                if ($user) {
                    $position_allowance = 5 / 100 * $user->sallary;
                    $bpjs = 5 / 100 * $user->sallary;
                    $jht = 5.7 / 100 * $user->sallary;
                    $pph21 = 0;
                    $employer_pays_fee = $position_allowance + $bpjs + $jht + $pph21;

                    $salary = Sallary::where('user_id', $user->id)->where('month', $month)->where('year', $year)->first();

                    if (!$salary) {
                        $salary = new Sallary();
                    }

                    $salary->user_id = $user->id;
                    $salary->month = $month;
                    $salary->year = $year;
                    $salary->basic_salary = $user->sallary;
                    $salary->bonus = $row[2];
                    $salary->performance_allowance = $row[4];
                    $salary->overtime = $row[3];
                    $salary->pph21 = $row[5];
                    $salary->jht = $jht;
                    $salary->bpjs = $bpjs;
                    $salary->position_allowance = $position_allowance < 500000 ? $position_allowance : 500000;
                    $salary->employer_pays_fee = $employer_pays_fee;
                    $salary->receivable_employee = 0;
                    $salary->status = 'paid';
                    $salary->save();
                }
            }
        }
    }
}
