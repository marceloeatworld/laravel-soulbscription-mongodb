<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    protected $connection = 'mongodb';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_tickets', function (Blueprint $table) {
            $table->id();
            $table->decimal('charges')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->foreignIdFor(\LucasDotVin\Soulbscription\Models\Feature::class)->constrained()->cascadeOnDelete();
            $table->timestamps();

            if (config('soulbscription.models.subscriber.uses_uuid')) {
                $table->uuidMorphs('subscriber');
            } else {
                $table->numericMorphs('subscriber');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature_tickets');
    }
};
