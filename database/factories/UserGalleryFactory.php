<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserGallery;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserGalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserGallery::class;

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
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'type' => $this->faker->word(),
            'metadata' => [],
            'thumbnail' => $this->faker->text(),
            'user_id' => User::factory(),
        ];
    }
}
