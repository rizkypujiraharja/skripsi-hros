<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CustomerReport implements FromView, ShouldAutoSize
{
	
	public function __construct(object $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('report.customer', [
            'reports' => $this->data,
        ]);
    }
}