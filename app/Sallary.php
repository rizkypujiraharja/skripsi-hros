<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sallary extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the Sallary
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalSallary()
    {
        return $this->basic_salary + $this->bonus + $this->performance_allowance + $this->overtime + $this->employer_pays_fee;
    }

    public function getCutsSallary()
    {
        return $this->bpjs + $this->pph21 + $this->jht + $this->position_allowance + $this->receivable_employee;
    }

    public function getFinalSallary()
    {
        return $this->basic_salary + $this->bonus + $this->performance_allowance + $this->overtime;
    }

    public function getTotalSallaryRupiah()
    {
        return 'Rp. ' . number_format($this->getTotalSallary(), 0, ',', '.');
    }

    public function getTotalCutsRupiah()
    {
        return 'Rp. ' . number_format($this->getCutsSallary(), 0, ',', '.');
    }

    public function getTotalFinalSallaryRupiah()
    {
        return 'Rp. ' . number_format($this->getFinalSallary(), 0, ',', '.');
    }

    public function periode()
    {
        $months = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        return $months[$this->month] . ' ' . $this->year;
    }
}
