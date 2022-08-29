<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SallaryReport implements FromView, ShouldAutoSize
{

    public function __construct($sallaries)
    {
        $this->sallaries = $sallaries;
    }

    public function view(): View
    {
        return view('excel.sallaries', [
            'sallaries' => $this->sallaries,
        ]);
    }
}
