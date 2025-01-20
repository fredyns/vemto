<?php

namespace Tests\Feature\Api;

use App\Models\Record;
use App\Models\Subrecord;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RecordSubrecordsTest extends TestCase
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
    public function it_gets_record_subrecords(): void
    {
        $record = Record::factory()->create();
        $subrecords = Subrecord::factory()
            ->count(2)
            ->create([
                'record_id' => $record->id,
            ]);

        $response = $this->getJson(
            route('api.records.subrecords.index', $record)
        );

        $response->assertOk()->assertSee($subrecords[0]->date);
    }

    /**
     * @test
     */
    public function it_stores_the_record_subrecords(): void
    {
        $record = Record::factory()->create();
        $data = Subrecord::factory()
            ->make([
                'record_id' => $record->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.records.subrecords.store', $record),
            $data
        );

        $this->assertDatabaseHas('subrecords', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $subrecord = Subrecord::latest('id')->first();

        $this->assertEquals($record->id, $subrecord->record_id);
    }
}
