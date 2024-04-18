<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'mongodb';

    public function up()
    {
        Schema::create('subscription_renewals', function (Blueprint $table) {
            $table->id();
            $table->boolean('overdue');
            $table->boolean('renewal');
            $table->foreignIdFor(\MarceloEatWorld\Soulbscription\Models\Subscription::class);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscription_renewals');
    }
};