<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use MarceloEatWorld\Soulbscription\Enums\PeriodicityType;
use MarceloEatWorld\Soulbscription\Models\Feature;
use Tests\TestCase;

class FeatureTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testModelCalculateYearlyExpiration()
    {
        Carbon::setTestNow(now());

        $years = $this->faker->randomDigitNotNull();
        $feature = Feature::factory()->create([
            'periodicity_type' => PeriodicityType::Year,
            'periodicity' => $years,
        ]);

        $this->assertEquals(now()->addYears($years), $feature->calculateNextRecurrenceEnd());
    }

    public function testModelCalculateMonthlyExpiration()
    {
        Carbon::setTestNow(now());

        $months = $this->faker->randomDigitNotNull();
        $feature = Feature::factory()->create([
            'periodicity_type' => PeriodicityType::Month,
            'periodicity' => $months,
        ]);

        $this->assertEquals(now()->addMonths($months), $feature->calculateNextRecurrenceEnd());
    }

    public function testModelCalculateWeeklyExpiration()
    {
        Carbon::setTestNow(now());

        $weeks = $this->faker->randomDigitNotNull();
        $feature = Feature::factory()->create([
            'periodicity_type' => PeriodicityType::Week,
            'periodicity' => $weeks,
        ]);

        $this->assertEquals(now()->addWeeks($weeks), $feature->calculateNextRecurrenceEnd());
    }

    public function testModelCalculateDailyExpiration()
    {
        Carbon::setTestNow(now());

        $days = $this->faker->randomDigitNotNull();
        $feature = Feature::factory()->create([
            'periodicity_type' => PeriodicityType::Day,
            'periodicity' => $days,
        ]);

        $this->assertEquals(now()->addDays($days), $feature->calculateNextRecurrenceEnd());
    }

    public function testModelcalculateNextRecurrenceEndConsideringRecurrences()
    {
        Carbon::setTestNow(now());

        $feature = Feature::factory()->create([
            'periodicity_type' => PeriodicityType::Week,
            'periodicity' => 1,
        ]);

        $startDate = now()->subDays(11);

        $this->assertEquals(now()->addDays(3), $feature->calculateNextRecurrenceEnd($startDate));
    }

    public function testModelIsNotQuotaByDefault()
    {
        $creationPayload = Feature::factory()->raw();

        unset($creationPayload['quota']);

        $feature = Feature::create($creationPayload);

        $this->assertDatabaseHas('features', [
            'id' => $feature->id,
            'quota' => false,
        ]);
    }
}
