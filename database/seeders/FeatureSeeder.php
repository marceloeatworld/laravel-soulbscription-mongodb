<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use MarceloEatWorld\Soulbscription\Models\Feature;
use MarceloEatWorld\Soulbscription\Models\Plan;

class FeatureSeeder extends Seeder
{
    public function run()
    {
        $photoboothCredits = Feature::create([
            'consumable' => true,
            'name' => 'photobooth_credits',
        ]);

        $creationCredits = Feature::create([
            'consumable' => true,
            'name' => 'creation_credits',
        ]);

        $free = Plan::whereName('Curious')->first();
        $basic = Plan::whereName('Explorer')->first();
        $pro = Plan::whereName('Genius')->first();

        $photoboothCredits->plans()->attach([
            $free->id => ['charges' => 5.0],
            $basic->id => ['charges' => 1000.0],
            $pro->id => ['charges' => 10000.0],
        ]);

        $creationCredits->plans()->attach([
            $basic->id => ['charges' => 500.0],
            $pro->id => ['charges' => 1000.0],
        ]);
    }
}