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
        $free->features()->attach($photoboothCredits, ['charges' => 5.0]);

        $basic = Plan::whereName('Explorer')->first();
        $basic->features()->attach($photoboothCredits, ['charges' => 1000.0]);
        $basic->features()->attach($creationCredits, ['charges' => 500.0]);

        $pro = Plan::whereName('Genius')->first();
        $pro->features()->attach($photoboothCredits, ['charges' => 10000.0]);
        $pro->features()->attach($creationCredits, ['charges' => 1000.0]);

        // Mise à jour des champs `plan_ids` dans les modèles Feature
        $photoboothCredits->plan_ids = [$free->id, $basic->id, $pro->id];
        $photoboothCredits->save();

        $creationCredits->plan_ids = [$basic->id, $pro->id]