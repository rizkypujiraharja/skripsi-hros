<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SampleSallaryReport implements FromView, ShouldAutoSize
{

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function view(): View
    {
        return view('excel.sample', [
            'users' => $this->users,
        ]);
    }
}
