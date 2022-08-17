<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StockProductReport implements FromView, ShouldAutoSize
{

    public function __construct(object $data, $filename)
    {
        $this->data = $data;
        $this->filename = $filename;
    }

    public function view(): View
    {
        return view('report.stock_product', [
            'products' => $this->data,
            'filename' => $this->filename,
        ]);
    }
}
