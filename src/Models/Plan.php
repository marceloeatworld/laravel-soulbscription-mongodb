<?php

namespace MarceloEatWorld\Soulbscription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use MarceloEatWorld\Soulbscription\Models\Concerns\HandlesRecurrence;

class Plan extends Model
{
    use HandlesRecurrence;
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'mongodb';

    protected $fillable = [
        'grace_days',
        'name',
        'periodicity_type',
        'periodicity',
        'feature_ids',
    ];

    protected $casts = [
        'feature_ids' => 'array',
    ];

    public function features()
    {
        return $this->hasMany(config('soulbscription.models.feature'), 'plan_ids.'.$this->id);
    }

    public function subscriptions()
    {
        return $this->hasMany(config('soulbscription.models.subscription'));
    }

    public function calculateGraceDaysEnd(Carbon $recurrenceEnd)
    {
        return $recurrenceEnd->copy()->addDays($this->grace_days);
    }

    public function getHasGraceDaysAttribute()
    {
        return ! empty($this->grace_days);
    }

    public function getFeatureCharges($featureId)
    {
        foreach ($this->feature_ids as $featureData) {
            if ($featureData['feature_id'] == $featureId) {
                return $featureData['charges'];
            }
        }

        return null;
    }
}