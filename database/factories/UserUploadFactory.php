<?php

namespace Database\Factories;

use App\Models\UserUpload;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserUploadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserUpload::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'at' => $this->faker->dateTime('now', 'UTC'),
            'file' => $this->faker->text(),
            'name' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'type' => $this->faker->word(),
            'metadata' => [],
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
