<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\UserGallery;
use Database\Seeders\PermissionsSeeder;
use DB;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserGalleryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    protected function castToJson($json)
    {
        if (is_array($json)) {
            $json = addslashes(json_encode($json));
        } elseif (is_null($json) || is_null(json_decode($json))) {
            throw new Exception(
                'A valid JSON string was not provided for casting.'
            );
        }

        return DB::raw("CAST('{$json}' AS JSON)");
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_user_galleries(): void
    {
        $userGalleries = UserGallery::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('user-galleries.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.user_galleries.index')
            ->assertViewHas('userGalleries');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_user_gallery(): void
    {
        $response = $this->get(route('user-galleries.create'));

        $response->assertOk()->assertViewIs('app.user_galleries.create');
    }

    /**
     * @test
     */
    public function it_stores_the_user_gallery(): void
    {
        $data = UserGallery::factory()
            ->make()
            ->toArray();

        $data['metadata'] = json_encode($data['metadata']);

        $response = $this->post(route('user-galleries.store'), $data);

        $data['metadata'] = $this->castToJson($data['metadata']);

        $this->assertDatabaseHas('user_galleries', $data);

        $userGallery = UserGallery::latest('id')->first();

        $response->assertRedirect(route('user-galleries.edit', $userGallery));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_user_gallery(): void
    {
        $userGallery = UserGallery::factory()->create();

        $response = $this->get(route('user-galleries.show', $userGallery));

        $response
            ->assertOk()
            ->assertViewIs('app.user_galleries.show')
            ->assertViewHas('userGallery');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_user_gallery(): void
    {
        $userGallery = UserGallery::factory()->create();

        $response = $this->get(route('user-galleries.edit', $userGallery));

        $response
            ->assertOk()
            ->assertViewIs('app.user_galleries.edit')
            ->assertViewHas('userGallery');
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

        $data['metadata'] = json_encode($data['metadata']);

        $response = $this->put(
            route('user-galleries.update', $userGallery),
            $data
        );

        $data['id'] = $userGallery->id;

        $data['metadata'] = $this->castToJson($data['metadata']);

        $this->assertDatabaseHas('user_galleries', $data);

        $response->assertRedirect(route('user-galleries.edit', $userGallery));
    }

    /**
     * @test
     */
    public function it_deletes_the_user_gallery(): void
    {
        $userGallery = UserGallery::factory()->create();

        $response = $this->delete(
            route('user-galleries.destroy', $userGallery)
        );

        $response->assertRedirect(route('user-galleries.index'));

        $this->assertModelMissing($userGallery);
    }
}
