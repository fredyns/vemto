<?php

namespace Tests\Feature\Api;

use App\Models\Record;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RecordTest extends TestCase
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
    public function it_gets_records_list(): void
    {
        $records = Record::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.records.index'));

        $response->assertOk()->assertSee($records[0]->string);
    }

    /**
     * @test
     */
    public function it_stores_the_record(): void
    {
        $data = Record::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.records.store'), $data);

        unset($data['created_by']);
        unset($data['updated_by']);

        $this->assertDatabaseHas('records', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.records.update', $record), $data);

        unset($data['created_by']);
        unset($data['updated_by']);

        $data['id'] = $record->id;

        $this->assertDatabaseHas('records', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_record(): void
    {
        $record = Record::factory()->create();

        $response = $this->deleteJson(route('api.records.destroy', $record));

        $this->assertModelMissing($record);

        $response->assertNoContent();
    }
}
