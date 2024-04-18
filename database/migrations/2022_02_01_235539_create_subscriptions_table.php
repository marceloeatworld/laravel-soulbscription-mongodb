<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'mongodb';

    public function up()
    {
        Schema::create('sb_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\LucasDotVin\Soulbscription\Models\Plan::class);
            $table->timestamp('canceled_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('grace_days_ended_at')->nullable();
            $table->date('started_at');
            $table->timestamp('suppressed_at')->nullable();
            $table->boolean('was_switched')->default(false);
            $table->softDeletes();
            $table->timestamps();
            if (config('soulbscription.models.subscriber.uses_uuid')) {
                $table->uuidMorphs('subscriber');
            } else {
                $table->numericMorphs('subscriber');
            }
        });
    }

    public function down()
    {
        Schema::dropIfExists('sb_subscriptions');
    }
};