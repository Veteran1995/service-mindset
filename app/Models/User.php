<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'employee_id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function assignedTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'assigned_to_id');
    }

    public function assignedByTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'assigned_by_id');
    }

    public function member()
    {
        return $this->hasOne(CrewMember::class, 'member_id');
    }

    public function crew()
    {
        return $this->hasOne(Crew::class, 'supervisor_id');
    }

    public function receivedEmails()
    {
        return $this->hasMany(Email::class, 'receiver_id');
    }

    public function sentEmails()
    {
        return $this->hasMany(Email::class, 'sender_id');
    }

    public function meterAssignments()
    {
        return $this->hasMany(MeterAssignment::class, 'user_id');
    }

    public function taskComments()
    {
        return $this->hasMany(TaskComment::class, 'sender_id');
    }

    public function histories()
    {
        return $this->hasMany(ItineraryHistory::class, 'user_id');
    }

    public function currentLocations()
    {
        return $this->hasMany(UserCurrentLocation::class, 'user_id');
    }



    /**
     * Get the total number of users.
     *
     * @return int
     */
    public static function getTotalUsers()
    {
        return self::count();
    }

    /**
     * Get the total number of admin users.
     *
     * @return int
     */
    public static function getTotalAdminUsers()
    {
        return self::where('role', 'admin')->count();
    }

    /**
     * Get the total number of admin users.
     *
     * @return int
     */
    public static function getTotalAgentUsers()
    {
        return self::where('role', 'agent')->count();
    }


    /**
     * Get the total number of active users.
     *
     * @return int
     */
    public static function getTotalActiveUsers()
    {
        return self::where('status', 1)->count();
    }

    /**
     * Get the total number of inactive users.
     *
     * @return int
     */
    public static function getTotalInactiveUsers()
    {
        return self::where('status', 0)->count();
    }

    // ...
}
