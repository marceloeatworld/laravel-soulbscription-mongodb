<?php

namespace MarceloEatWorld\Soulbscription\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use MarceloEatWorld\Soulbscription\Models\Subscription;

class SubscriptionStarted
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        public Subscription $subscription,
    ) {
        //
    }
}
