<?php

namespace Tests\Feature\Controllers;

use App\Models\Record;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecordControllerTest extends TestCase
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

    /**
     * @test
     */
    public function it_displays_index_view_with_records(): void
    {
        $records = Record::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('records.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.records.index')
            ->assertViewHas('records');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_record(): void
    {
        $response = $this->get(route('records.create'));

        $response->assertOk()->assertViewIs('app.records.create');
    }

    /**
     * @test
     */
    public function it_stores_the_record(): void
    {
        $data = Record::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('records.store'), $data);

        unset($data['created_by']);
        unset($data['updated_by']);

        $this->assertDatabaseHas('records', $data);

        $record = Record::latest('id')->first();

        $response->assertRedirect(route('records.edit', $record));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_record(): void
    {
        $record = Record::factory()->create();

        $response = $this->get(route('records.show', $record));

        $response
            ->assertOk()
            ->assertViewIs('app.records.show')
            ->assertViewHas('record');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_record(): void
    {
        $record = Record::factory()->create();

        $response = $this->get(route('records.edit', $record));

        $response
            ->assertOk()
            ->assertViewIs('app.records.edit')
            ->assertViewHas('record');
    }

    /**
     * @test
     */
    public function it_updates_the_record(): void
    {
        $record = Record::factory()->create();

        $user = User::factory()->create();

        $data = [
            'created_by' => $this->faker->uuid(),
            'updated_by' => $this->faker->uuid(),
            'user_id' => $this->faker->uuid(),
            'string' => $this->faker->city(),
            'email' => $this->faker->email(),
            'integer' => $this->faker->randomNumber(0),
            'decimal' => $this->faker->randomNumber(1),
            'n_p_w_p' => $this->faker->randomNumber(),
            'datetime' => $this->faker->dateTime(),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'i_p_address' => $this->faker->ipv4(),
            'boolean' => $this->faker->boolean(),
            'enumerate' => 'enabled',
            'text' => $this->faker->text(),
            'file' => $this->faker->text(),
            'image' => $this->faker->text(),
            'markdown_text' => $this->faker->text(),
            'w_y_s_i_w_y_g' => $this->faker->text(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'user_id' => $user->id,
        ];

        $response = $this->put(route('records.update', $record), $data);

        unset($data['created_by']);
        unset($data['updated_by']);

        $data['id'] = $record->id;

        $this->assertDatabaseHas('records', $data);

        $response->assertRedirect(route('records.edit', $record));
    }

    /**
     * @test
     */
    public function it_deletes_the_record(): void
    {
        $record = Record::factory()->create();

        $response = $this->delete(route('records.destroy', $record));

        $response->assertRedirect(route('records.index'));

        $this->assertModelMissing($record);
    }
}
