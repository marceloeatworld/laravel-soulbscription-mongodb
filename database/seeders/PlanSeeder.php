<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use MarceloEatWorld\Soulbscription\Enums\PeriodicityType;
use MarceloEatWorld\Soulbscription\Models\Plan;

class PlanSeeder extends Seeder
{
    public function run()
    {
        $free = Plan::create([
            'name'             => 'Curious',
            'periodicity_type' => PeriodicityType::Week,
            'periodicity'      => 1,
        ]);

        $basic = Plan::create([
            'name'             => 'Explorer',
            'periodicity_type' => PeriodicityType::Month,
            'periodicity'      => 1,
        ]);

        $pro = Plan::create([
            'name'             => 'Genius',
            'periodicity_type' => PeriodicityType::Month,
            'periodicity'      => 1,
        ]);
    }
}