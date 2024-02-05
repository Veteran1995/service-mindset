<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $table = 'service_order_data';

    protected $guarded = [];

    public function meter()
    {
        return $this->belongsTo(Meter::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cnumber', 'cnumber');
    }

    public function crew()
    {
        return $this->belongsTo(Crew::class);
    }

    public function task()
    {
        return $this->hasOne(Task::class);
    }

    /**
     * Get the total number of users.
     *
     * @return int
     */
    public static function getTotalServiceOrders()
    {
        return self::count();
    }

    /**
     * Get the total number of admin users.
     *
     * @return int
     */
    public static function getTotalAssignedOrders()
    {
        return self::where('contract_status', 1)->count();
    }

    /**
     * Get the total number of admin users.
     *
     * @return int
     */
    public static function getTotalUnassignedOrders()
    {
        return self::where('contract_status', 0)->count();
    }

    public static function getTotalCompletedOrders()
    {
        return self::where('contract_status', 1)->count();
    }
}
