<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function members()
    {
        return $this->hasMany(CrewMember::class, 'crew_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id', 'employee_id');
    }

    public function meters()
    {
        return $this->belongsToMany(Meter::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public static function getTotalCrews()
    {
        return self::count();
    }

    /**
     * Get the total number of admin users.
     *
     * @return int
     */
    public static function getTotalActiveCrews()
    {
        return self::where('status', 'Active')->count();
    }

    /**
     * Get the total number of admin users.
     *
     * @return int
     */
    public static function getTotalInactiveCrews()
    {
        return self::where('status', 'Inactive')->count();
    }
}
