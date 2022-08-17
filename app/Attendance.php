<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
