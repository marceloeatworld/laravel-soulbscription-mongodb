<?php

namespace LucasDotVin\Soulbscription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use LucasDotVin\Soulbscription\Models\Concerns\HandlesRecurrence;

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
    ];

    public function features()
    {
        return $this->belongsToMany(config('soulbscription.models.feature'))
            ->using(config('soulbscription.models.feature_plan'))
            ->withPivot(['charges']);
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
}
