<?php

namespace App\Http\Controllers;

use App\Exports\SampleSallaryReport;
use App\Imports\SallariesImport;
use App\Sallary;
use App\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SallaryController extends Controller
{
    public function index(Request $request)
    {
        $sallaries = Sallary::with('user');

        $sallaries = $sallaries->paginate();

        return view('sallaries.index', compact('sallaries'));
    }

    public function import(Request $request)
    {
        $month = date('m');
        $year = date('Y');

        Excel::import(new SallariesImport, $request->file);

        return redirect()->back()->with('alert-success', 'Berhasil membuat draft gaji');
    }

    public function downloadSample()
    {
        $users = User::get();

        foreach ($users as $user) {
            $position_allowance = 5 / 100 * $user->sallary;
            $bpjs = 5 / 100 * $user->sallary;
            $jht = 5.7 / 100 * $user->sallary;
            $pph21 = 0;
            $employer_pays_fee = $position_allowance + $bpjs + $jht + $pph21;

            $user->data = [
                'position_allowance' => $position_allowance,
                'bpjs' => $bpjs,
                'jht' => $jht,
                'pph21' => $pph21,
                'employer_pays_fee' => $employer_pays_fee,
            ];
        }

        return Excel::download(new SampleSallaryReport($users), 'Data Penggajian.xlsx');
    }
}
