<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StockMaterialReport implements FromView, ShouldAutoSize
{
	
	public function __construct(object $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('report.stock_material', [
            'reports' => $this->data
        ]);
    }
}