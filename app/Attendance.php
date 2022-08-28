<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'date', 'time_in', 'time_out', 'status', 'type', 'description', 'file',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusBadgeAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return "<span class='badge badge-warning'>Pending</span>";

            case 'rejected':
                return "<span class='badge badge-danger'>Rejected</span>";

            default:
                return "<span class='badge badge-success'>Approved</span>";
        }
    }

    public function getTypeBadgeAttribute()
    {
        switch ($this->type) {
            case 'sick':
                return "<span class='badge badge-warning'>Sakit</span>";

            case 'paid_leave':
                return "<span class='badge badge-info'>Cuti</span>";

            case 'permission':
                return "<span class='badge badge-light'>Izin</span>";

            case 'not_attend':
                return "<span class='badge badge-danger'>Tidak Hadir</span>";

            default:
                return "<span class='badge badge-success'>Masuk</span>";
        }
    }

    public function getFileUrlAttribute()
    {
        if ($this->file) {
            return Storage::url($this->file);
        }

        return null;
    }
}
