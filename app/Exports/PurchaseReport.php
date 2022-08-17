<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PurchaseReport implements FromView, ShouldAutoSize
{
	
	public function __construct(object $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('report.purchase', [
            'reports' => $this->data
        ]);
    }
}