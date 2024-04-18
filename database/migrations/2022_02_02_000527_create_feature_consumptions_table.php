<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'mongodb';

    public function up()
    {
        Schema::create('feature_consumptions', function (Blueprint $table) {
            $table->id();
            $table->decimal('consumption')->unsigned()->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->foreignIdFor(\MarceloEatWorld\Soulbscription\Models\Feature::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('feature_consumptions');
    }
};