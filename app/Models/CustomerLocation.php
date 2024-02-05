<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLocation extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function customer()

    {

        return $this->belongsTo(Customer::class, 'cnumber', 'cnumber');
    }
}
