<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Subrecord;

use App\Models\Record;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubrecordTest extends TestCase
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
    public function it_gets_subrecords_list(): void
    {
        $subrecords = Subrecord::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.subrecords.index'));

        $response->assertOk()->assertSee($subrecords[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_subrecord(): void
    {
        $data = Subrecord::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.subrecords.store'), $data);

        $this->assertDatabaseHas('subrecords', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_subrecord(): void
    {
        $subrecord = Subrecord::factory()->create();

        $record = Record::factory()->create();

        $data = [
            'datetime' => $this->faker->dateTime(),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'n_p_w_p' => $this->faker->randomNumber(),
            'markdown_text' => $this->faker->text(),
            'w_y_s_i_w_y_g' => $this->faker->text(),
            'file' => $this->faker->text(),
            'image' => $this->faker->text(),
            'i_p_address' => $this->faker->ipv4(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'record_id' => $record->id,
        ];

        $response = $this->putJson(
            route('api.subrecords.update', $subrecord),
            $data
        );

        $data['id'] = $subrecord->id;

        $this->assertDatabaseHas('subrecords', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_subrecord(): void
    {
        $subrecord = Subrecord::factory()->create();

        $response = $this->deleteJson(
            route('api.subrecords.destroy', $subrecord)
        );

        $this->assertModelMissing($subrecord);

        $response->assertNoContent();
    }
}
