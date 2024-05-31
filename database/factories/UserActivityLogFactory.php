<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\UserActivityLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserActivityLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserActivityLog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'at' => $this->faker->dateTime('now', 'UTC'),
            'title' => $this->faker->sentence(10),
            'link' => $this->faker->text(),
            'message' => $this->faker->sentence(20),
            'i_p_address' => $this->faker->ipv4(),
            'user_id' => User::factory(),
        ];
    }
}
