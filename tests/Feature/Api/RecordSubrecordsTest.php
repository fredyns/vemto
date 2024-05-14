<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Record;
use App\Models\Subrecord;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecordSubrecordsTest extends TestCase
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

        unset($data['record_id']);

        $this->assertDatabaseHas('subrecords', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $subrecord = Subrecord::latest('id')->first();

        $this->assertEquals($record->id, $subrecord->record_id);
    }
}
