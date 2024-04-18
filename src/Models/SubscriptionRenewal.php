<?php

namespace MarceloEatWorld\Soulbscription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class SubscriptionRenewal extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $casts = [
        'overdue' => 'boolean',
        'renewal' => 'boolean',
    ];

    protected $fillable = [
        'overdue',
        'renewal',
    ];

    public function subscription()
    {
        return $this->belongsTo(config('soulbscription.models.subscription'));
    }
}