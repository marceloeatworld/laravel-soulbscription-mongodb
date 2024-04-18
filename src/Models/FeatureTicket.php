<?php

namespace LucasDotVin\Soulbscription\Models;

use MongoDB\Laravel\Eloquent\Model;
use LucasDotVin\Soulbscription\Models\Concerns\Expires;

class FeatureTicket extends Model
{
    use Expires;

    protected $connection = 'mongodb';

    protected $fillable = [
        'charges',
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