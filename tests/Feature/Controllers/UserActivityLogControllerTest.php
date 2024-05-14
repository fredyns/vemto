<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\UserActivityLog;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserActivityLogControllerTest extends TestCase
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

    /**
     * @test
     */
    public function it_displays_index_view_with_user_activity_logs(): void
    {
        $userActivityLogs = UserActivityLog::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('user-activity-logs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.user_activity_logs.index')
            ->assertViewHas('userActivityLogs');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_user_activity_log(): void
    {
        $response = $this->get(route('user-activity-logs.create'));

        $response->assertOk()->assertViewIs('app.user_activity_logs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_user_activity_log(): void
    {
        $data = UserActivityLog::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('user-activity-logs.store'), $data);

        $this->assertDatabaseHas('user_activity_logs', $data);

        $userActivityLog = UserActivityLog::latest('id')->first();

        $response->assertRedirect(
            route('user-activity-logs.edit', $userActivityLog)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_user_activity_log(): void
    {
        $userActivityLog = UserActivityLog::factory()->create();

        $response = $this->get(
            route('user-activity-logs.show', $userActivityLog)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.user_activity_logs.show')
            ->assertViewHas('userActivityLog');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_user_activity_log(): void
    {
        $userActivityLog = UserActivityLog::factory()->create();

        $response = $this->get(
            route('user-activity-logs.edit', $userActivityLog)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.user_activity_logs.edit')
            ->assertViewHas('userActivityLog');
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

        $response = $this->put(
            route('user-activity-logs.update', $userActivityLog),
            $data
        );

        $data['id'] = $userActivityLog->id;

        $this->assertDatabaseHas('user_activity_logs', $data);

        $response->assertRedirect(
            route('user-activity-logs.edit', $userActivityLog)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_user_activity_log(): void
    {
        $userActivityLog = UserActivityLog::factory()->create();

        $response = $this->delete(
            route('user-activity-logs.destroy', $userActivityLog)
        );

        $response->assertRedirect(route('user-activity-logs.index'));

        $this->assertModelMissing($userActivityLog);
    }
}
