<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\UserUpload;
use DB;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserUploadControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

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
    public function it_displays_index_view_with_user_uploads(): void
    {
        $userUploads = UserUpload::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('user-uploads.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.user_uploads.index')
            ->assertViewHas('userUploads');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_user_upload(): void
    {
        $response = $this->get(route('user-uploads.create'));

        $response->assertOk()->assertViewIs('app.user_uploads.create');
    }

    /**
     * @test
     */
    public function it_stores_the_user_upload(): void
    {
        $data = UserUpload::factory()
            ->make()
            ->toArray();

        $data['metadata'] = json_encode($data['metadata']);

        $response = $this->post(route('user-uploads.store'), $data);

        $data['metadata'] = $this->castToJson($data['metadata']);

        $this->assertDatabaseHas('user_uploads', $data);

        $userUpload = UserUpload::latest('id')->first();

        $response->assertRedirect(route('user-uploads.edit', $userUpload));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_user_upload(): void
    {
        $userUpload = UserUpload::factory()->create();

        $response = $this->get(route('user-uploads.show', $userUpload));

        $response
            ->assertOk()
            ->assertViewIs('app.user_uploads.show')
            ->assertViewHas('userUpload');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_user_upload(): void
    {
        $userUpload = UserUpload::factory()->create();

        $response = $this->get(route('user-uploads.edit', $userUpload));

        $response
            ->assertOk()
            ->assertViewIs('app.user_uploads.edit')
            ->assertViewHas('userUpload');
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

        $data['metadata'] = json_encode($data['metadata']);

        $response = $this->put(
            route('user-uploads.update', $userUpload),
            $data
        );

        $data['id'] = $userUpload->id;

        $data['metadata'] = $this->castToJson($data['metadata']);

        $this->assertDatabaseHas('user_uploads', $data);

        $response->assertRedirect(route('user-uploads.edit', $userUpload));
    }

    /**
     * @test
     */
    public function it_deletes_the_user_upload(): void
    {
        $userUpload = UserUpload::factory()->create();

        $response = $this->delete(route('user-uploads.destroy', $userUpload));

        $response->assertRedirect(route('user-uploads.index'));

        $this->assertModelMissing($userUpload);
    }
}
