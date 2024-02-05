<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LossReductionCaseType extends Model
{
    protected $guarded = [];
    protected $table = 'loss_reduction_case_types';
    use HasFactory;

    // Define the primary key and disable auto-increment
    protected $primaryKey = 'case_id';
    public $incrementing = false;

    // Other model properties and methods

    public function lossReductionCase()
    {
        return $this->belongsTo(LossReductionCase::class, 'case_id');
    }
}
