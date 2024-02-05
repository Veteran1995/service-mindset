<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'logistics_name',
        // Add other logistics fields as needed
    ];

    public function meter()
    {
        return $this->belongsTo(Meter::class);
    }
}
