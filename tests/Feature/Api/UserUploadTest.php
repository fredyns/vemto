<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\UserUpload;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserUploadTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_user_uploads_list(): void
    {
        $userUploads = UserUpload::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.user-uploads.index'));

        $response->assertOk()->assertSee($userUploads[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_upload(): void
    {
        $data = UserUpload::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.user-uploads.store'), $data);

        $this->assertDatabaseHas('user_uploads', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_user_upload(): void
    {
        $userUpload = UserUpload::factory()->create();

        $user = User::factory()->create();

        $data = [
            'user_id' => $this->faker->uuid(),
            'at' => $this->faker->dateTime('now', 'UTC'),
            'file' => $this->faker->text(),
            'name' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'type' => $this->faker->word(),
            'metadata' => [],
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.user-uploads.update', $userUpload),
            $data
        );

        $data['id'] = $userUpload->id;

        $this->assertDatabaseHas('user_uploads', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_user_upload(): void
    {
        $userUpload = UserUpload::factory()->create();

        $response = $this->deleteJson(
            route('api.user-uploads.destroy', $userUpload)
        );

        $this->assertModelMissing($userUpload);

        $response->assertNoContent();
    }
}
