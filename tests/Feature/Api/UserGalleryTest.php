<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\UserGallery;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserGalleryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_user_galleries_list(): void
    {
        $userGalleries = UserGallery::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.user-galleries.index'));

        $response->assertOk()->assertSee($userGalleries[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_gallery(): void
    {
        $data = UserGallery::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.user-galleries.store'), $data);

        $this->assertDatabaseHas('user_galleries', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_user_gallery(): void
    {
        $userGallery = UserGallery::factory()->create();

        $user = User::factory()->create();

        $data = [
            'user_id' => $this->faker->uuid(),
            'at' => $this->faker->dateTime('now', 'UTC'),
            'file' => $this->faker->text(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'type' => $this->faker->word(),
            'metadata' => [],
            'thumbnail' => $this->faker->text(),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.user-galleries.update', $userGallery),
            $data
        );

        $data['id'] = $userGallery->id;

        $this->assertDatabaseHas('user_galleries', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_user_gallery(): void
    {
        $userGallery = UserGallery::factory()->create();

        $response = $this->deleteJson(
            route('api.user-galleries.destroy', $userGallery)
        );

        $this->assertModelMissing($userGallery);

        $response->assertNoContent();
    }
}
