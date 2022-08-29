<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        return url('/stisla-2.2.0/dist/assets/img/avatar/avatar-3.png');
    }

    /**
     * Get all of the attendances for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get the division that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function isHrd()
    {
        return $this->role == 'hrd';
    }

    public function isFinance()
    {
        return $this->role == 'hrd';
    }

    public function getSallaryRupiahAttribute()
    {
        return 'Rp. ' . number_format($this->sallary, 0, ',', '.');
    }

    public function getOverview(Type $var = null)
    {
        $user = $this;
        $user->load('division');
        $joinAt = Carbon::parse($user->joined_at)->year(date('Y'));
        if ($joinAt > now()) {
            $joinAt = Carbon::parse($user->joined_at)->year(date('Y') - 1);
        }

        $totalPaidLeave = Attendance::where('user_id', $user->id)
            ->where('status', '!=', 'rejected')
            ->where('type', 'paid_leave')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->count();

        $remainingPaidLeave = 12 - $totalPaidLeave;

        $totalSick = Attendance::where('user_id', $user->id)
            ->where('status', '!=', 'rejected')
            ->where('type', 'sick')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->count();

        $totalPermission = Attendance::where('user_id', $user->id)
            ->where('status', '!=', 'rejected')
            ->where('type', 'permission')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->count();

        $totalNotPresent = Attendance::where('user_id', $user->id)
            ->where('type', 'not_attend')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->count();

        $total = [
            'remain_paid_leave' => $remainingPaidLeave,
            'sick' => $totalSick,
            'permission' => $totalPermission,
            'not_present' => $totalNotPresent,
        ];

        $period = $joinAt->format('Y-m-d') . ' s/d ' . date('Y-m-d');

        $stats = [];
        $stats[] = Attendance::where('user_id', $user->id)
            ->where('type', 'attend')
            ->where('status', 'approved')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->count();

        $stats[] = Attendance::where('user_id', $user->id)
            ->where('type', 'attend')
            ->where('status', 'approved')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->where('time_in', '>', '08:30')
            ->where('time_in', '<=', '08:45')
            ->count();

        $stats[] = Attendance::where('user_id', $user->id)
            ->where('type', 'attend')
            ->where('status', 'approved')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->where('time_in', '>', '08:45')
            ->where('time_in', '<=', '09:00')
            ->count();

        $stats[] = Attendance::where('user_id', $user->id)
            ->where('type', 'attend')
            ->where('status', 'approved')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->where('time_in', '>', '09:00')
            ->where('time_in', '<=', '09:15')
            ->count();

        $stats[] = Attendance::where('user_id', $user->id)
            ->where('type', 'attend')
            ->where('status', 'approved')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->where('time_in', '>', '09:15')
            ->where('time_in', '<=', '09:30')
            ->count();


        $stats[] = Attendance::where('user_id', $user->id)
            ->where('type', 'attend')
            ->where('status', 'approved')
            ->where('date', '>=', $joinAt)
            ->where('date', '<=', now())
            ->where('time_in', '>', '09:30')
            ->count();

        return compact('user', 'total', 'period', 'stats');
    }
}
