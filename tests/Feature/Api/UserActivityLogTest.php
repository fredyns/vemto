<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\UserActivityLog;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserActivityLogTest extends TestCase
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
    public function it_gets_user_activity_logs_list(): void
    {
        $userActivityLogs = UserActivityLog::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.user-activity-logs.index'));

        $response->assertOk()->assertSee($userActivityLogs[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_user_activity_log(): void
    {
        $data = UserActivityLog::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.user-activity-logs.store'),
            $data
        );

        $this->assertDatabaseHas('user_activity_logs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_user_activity_log(): void
    {
        $userActivityLog = UserActivityLog::factory()->create();

        $user = User::factory()->create();

        $data = [
            'at' => $this->faker->dateTime('now', 'UTC'),
            'user_id' => $this->faker->uuid(),
            'title' => $this->faker->sentence(10),
            'link' => $this->faker->text(),
            'message' => $this->faker->sentence(20),
            'i_p_address' => $this->faker->ipv4(),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.user-activity-logs.update', $userActivityLog),
            $data
        );

        $data['id'] = $userActivityLog->id;

        $this->assertDatabaseHas('user_activity_logs', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_user_activity_log(): void
    {
        $userActivityLog = UserActivityLog::factory()->create();

        $response = $this->deleteJson(
            route('api.user-activity-logs.destroy', $userActivityLog)
        );

        $this->assertModelMissing($userActivityLog);

        $response->assertNoContent();
    }
}
