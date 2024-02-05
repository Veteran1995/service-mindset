<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    protected $primaryKey = 'cnumber';
    public $incrementing = false;

    use HasFactory;

    public function meters()
    {
        return $this->hasMany(MeterData::class, 'contract_number', 'contract_number');
    }

    public function serviceOrders()
    {
        return $this->hasMany(ServiceOrderData::class, 'contract_number', 'contract_number');
    }
}
