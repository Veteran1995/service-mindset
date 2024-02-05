<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LossReductionCase extends Model
{
    protected $guarded = [];
    protected $table = 'loss_reduction_cases';
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($model) {
            // Check if the ID is not set (for new records)
            if (!$model->getAttribute('case_id')) {
                // Assuming you have a source attribute in your model
                $source = $model->getAttribute('source_of_detection');
    
                // Generate a new sequence value based on the source
                $latestRecord = static::where('source_of_detection', $source)->latest('case_id')->first();
    
                if ($latestRecord) {
                    $currentSequence = (int) substr($latestRecord->case_id, -3);
                    $newSequence = $currentSequence + 1;
                } else {
                    $newSequence = 1;
                }
    
                // Customize the prefix based on the source
                $prefix = '';
    
                switch ($source) {
                    case 'HOT4600':
                        $prefix = 'LR-HOT';
                        break;
                    case 'Field Request':
                        $prefix = 'LR-FR';
                        break;
                    case 'Complaints':
                        $prefix = 'LR-COMP';
                        break;
                    case 'Internal Stakeholder':
                        $prefix = 'LR-IS';
                        break;
                    // Add more cases for other sources
                    default:
                        $prefix = 'LR-ES';
                }
    
                $model->setAttribute('case_id', $prefix . '-' . str_pad($newSequence, 3, '0', STR_PAD_LEFT));
            }
        });
    }
    

    // Other model properties and methods
    public function comments()
    {
        return $this->hasMany(LossReductionEngagementUserComment::class, 'case_id');
    }

    public function lossReductionCaseType()
    {
        return $this->hasOne(LossReductionCaseType::class, 'case_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'loss_reduction_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_spn');
    }

    public function meter()
    {
        return $this->belongsTo(Meter::class, 'meter_number');
    }
}
