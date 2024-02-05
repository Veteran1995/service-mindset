<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LossReductionEngagementUserComment extends Model
{
    protected $guarded = [];
    protected $table = 'loss_reduction_enagement_user_comment';
    use HasFactory;

    public function case()
    {
        return $this->belongsTo(LossReductionCase::class, 'case_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
