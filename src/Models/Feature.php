<?php

namespace LucasDotVin\Soulbscription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;
use LucasDotVin\Soulbscription\Models\Concerns\HandlesRecurrence;

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
    ];

    public function plans()
    {
        return $this->belongsToMany(config('soulbscription.models.plan'))
            ->using(config('soulbscription.models.feature_plan'));
    }

    public function tickets()
    {
        return $this->hasMany(config('soulbscription.models.feature_ticket'));
    }
}
