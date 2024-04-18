<?php

namespace Tests\Feature\Models\Concerns;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use MarceloEatWorld\Soulbscription\Models\FeatureConsumption;
use Tests\TestCase;

class ExpiresTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public const MODEL = FeatureConsumption::class;

    public function testExpiredModelsAreNotReturnedByDefault()
    {
        $expiredModelsCount = $this->faker()->randomDigitNotNull();
        self::MODEL::factory()->count($expiredModelsCount)->create([
            'expired_at' => now()->subDay(),
        ]);

        $unexpiredModelsCount = $this->faker()->randomDigitNotNull();
        $unexpiredModels = self::MODEL::factory()->count($unexpiredModelsCount)->create([
            'expired_at' => now()->addDay(),
        ]);

        $returnedSubscriptions = self::MODEL::all();

        $this->assertEqualsCanonicalizing(
            $unexpiredModels->pluck('id')->toArray(),
            $returnedSubscriptions->pluck('id')->toArray(),
        );
    }

    public function testExpiredModelsAreReturnedWhenCallingMethodWithExpired()
    {
        $expiredModelsCount = $this->faker()->randomDigitNotNull();
        $expiredModels = self::MODEL::factory()->count($expiredModelsCount)->create([
            'expired_at' => now()->subDay(),
        ]);

        $unexpiredModelsCount = $this->faker()->randomDigitNotNull();
        $unexpiredModels = self::MODEL::factory()->count($unexpiredModelsCount)->create([
            'expired_at' => now()->addDay(),
        ]);

        $expectedSubscriptions = $expiredModels->concat($unexpiredModels);

        $returnedSubscriptions = self::MODEL::withExpired()->get();

        $this->assertEqualsCanonicalizing(
            $expectedSubscriptions->pluck('id')->toArray(),
            $returnedSubscriptions->pluck('id')->toArray(),
        );
    }

    public function testOnlyExpiredModelsAreReturnedWhenCallingMethodOnlyExpired()
    {
        $expiredModelsCount = $this->faker()->randomDigitNotNull();
        $expiredModels = self::MODEL::factory()->count($expiredModelsCount)->create([
            'expired_at' => now()->subDay(),
        ]);

        $unexpiredModelsCount = $this->faker()->randomDigitNotNull();
        self::MODEL::factory()->count($unexpiredModelsCount)->create([
            'expired_at' => now()->addDay(),
        ]);

        $returnedSubscriptions = self::MODEL::onlyExpired()->get();

        $this->assertEqualsCanonicalizing(
            $expiredModels->pluck('id')->toArray(),
            $returnedSubscriptions->pluck('id')->toArray(),
        );
    }

    public function testModelReturnsExpiredStatus()
    {
        $expiredModel = self::MODEL::factory()
            ->expired()
            ->create();

        $notExpiredModel = self::MODEL::factory()
            ->notExpired()
            ->create();

        $this->assertTrue($expiredModel->expired());
        $this->assertFalse($notExpiredModel->expired());
    }

    public function testModelReturnsNotExpiredStatus()
    {
        $expiredModel = self::MODEL::factory()
            ->expired()
            ->create();

        $notExpiredModel = self::MODEL::factory()
            ->notExpired()
            ->create();

        $this->assertFalse($expiredModel->notExpired());
        $this->assertTrue($notExpiredModel->notExpired());
    }

    public function testModelsWithoutExpirationDateAreReturnedByDefault()
    {
        $expiredModelsCount = $this->faker()->randomDigitNotNull();
        self::MODEL::factory()->count($expiredModelsCount)->create([
            'expired_at' => now()->subDay(),
        ]);

        $unexpiredModelsCount = $this->faker()->randomDigitNotNull();
        $unexpiredModels = self::MODEL::factory()->count($unexpiredModelsCount)->create([
            'expired_at' => null,
        ]);

        $returnedSubscriptions = self::MODEL::all();

        $this->assertEqualsCanonicalizing(
            $unexpiredModels->pluck('id')->toArray(),
            $returnedSubscriptions->pluck('id')->toArray(),
        );
    }
}
