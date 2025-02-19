<?php

namespace MarceloEatWorld\Soulbscription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MarceloEatWorld\Soulbscription\Models\Concerns\Expires;

class FeatureConsumption extends Model
{
    use Expires;
    use HasFactory;

    protected $connection = 'mongodb';

    protected $fillable = [
        'consumption',
        'expired_at',
    ];

    public function feature()
    {
        return $this->belongsTo(config('soulbscription.models.feature'));
    }

    public function subscriber()
    {
        return $this->morphTo('subscriber');
    }
}
