<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductionReport implements FromView, ShouldAutoSize
{
	
	public function __construct(object $data, $filename)
    {
        $this->data = $data;
        $this->filename = $filename;
    }

    public function view(): View
    {
        return view('report.production', [
            'reports' => $this->data,   
            'filename' => $this->filename,
        ]);
    }
}