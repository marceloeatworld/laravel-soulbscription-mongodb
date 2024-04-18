<?php

return [
    'database' => [
        'cancel_migrations_autoloading' => false,
    ],

    'feature_tickets' => env('SOULBSCRIPTION_FEATURE_TICKETS', false),

    'models' => [

        'feature' => \MarceloEatWorld\Soulbscription\Models\Feature::class,

        'feature_consumption' => \MarceloEatWorld\Soulbscription\Models\FeatureConsumption::class,

        'feature_ticket' => \MarceloEatWorld\Soulbscription\Models\FeatureTicket::class,

        'plan' => \MarceloEatWorld\Soulbscription\Models\Plan::class,

        'subscriber' => [
            'uses_uuid' => env('SOULBSCRIPTION_SUBSCRIBER_USES_UUID', false),
        ],

        'subscription' => \MarceloEatWorld\Soulbscription\Models\Subscription::class,

        'subscription_renewal' => \MarceloEatWorld\Soulbscription\Models\SubscriptionRenewal::class,
    ],
];
