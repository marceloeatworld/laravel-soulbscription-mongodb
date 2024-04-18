<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    protected $connection = 'mongodb';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_plan', function (Blueprint $table) {
            $table->id();
            $table->decimal('charges')->nullable();
            $table->foreignIdFor(\LucasDotVin\Soulbscription\Models\Feature::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\LucasDotVin\Soulbscription\Models\Plan::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature_plan');
    }
};
