<?php

namespace App\Http\Controllers;

use App\Exports\SallaryReport;
use App\Exports\SampleSallaryReport;
use App\Imports\SallariesImport;
use App\Sallary;
use App\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function export(Request $request)
    {
        $sallaries = Sallary::where('month', $request->month)->where('year', $request->year)->get();

        $months = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $periode = $months[$request->month] . ' ' . $request->year;

        return Excel::download(new SallaryReport($sallaries), 'Data Penggajian Periode ' . $periode . '.xlsx');
    }

    public function slip(Request $request, Sallary $sallary)
    {
        $user = Auth::user();
        if ($user->isEmployee()) {
            if ($user->id != $sallary->user_id) {
                abort(403);
            }
        }

        $sallary->load('user');

        $logo = base64_encode(file_get_contents(public_path('/logo.png')));

        $pdf = Pdf::loadView('pdf.slip', compact('sallary', 'logo'))->setPaper('a5', 'landscape');
        return $pdf->download('Slip Gaji ' . $sallary->user->name . ' ' . $sallary->periode() . '.pdf');
    }
}
