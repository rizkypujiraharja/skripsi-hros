<?php

namespace App;

use App\Models\Jabatan;
use App\Models\Order;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return Storage::url($this->photo);
        }
        return Null;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function getLimitRemainingAdminAttribute()
    {
        $usage = $this->orders()
            ->whereBetween('status', [1, 3])
            ->where('created_at', ">=", now()->startOfMonth())
            ->withSum('details', 'sub_total_price')
            ->get()
            ->sum('details_sum_sub_total_price');
        return $this->limit_balance - $usage;
    }

    public function getLimitRemainingUserAttribute()
    {
        $usage = $this->orders()
            ->where('created_at', ">=", now()->startOfMonth())
            ->where('status', '<=', 4)
            ->withSum('details', 'sub_total_price')
            ->get()
            ->sum('details_sum_sub_total_price');
        return $this->limit_balance - $usage;
    }

    public function isUser()
    {
        return $this->role == 'user';
    }

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function isAdministrator()
    {
        return $this->role == 'administrator';
    }

    public function isKeuangan()
    {
        return $this->role == 'keuangan';
    }
}
