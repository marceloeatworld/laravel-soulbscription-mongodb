<?php

namespace MarceloEatWorld\Soulbscription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;
use MarceloEatWorld\Soulbscription\Models\Concerns\HandlesRecurrence;

class Feature extends Model
{
    use HandlesRecurrence;
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'mongodb';

    protected $fillable = [
        'consumable',
        'name',
        'periodicity_type',
        'periodicity',
        'quota',
        'postpaid',
        'plan_ids',
    ];

    protected $casts = [
        'plan_ids' => 'array',
    ];

    public function plans()
    {
        return $this->belongsToMany(config('soulbscription.models.plan'));
    }

    public function tickets()
    {
        return $this->hasMany(config('soulbscription.models.feature_ticket'));
    }
}