<?php

namespace Database\Factories;

use App\Models\Record;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Record::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userFactory = \App\Models\User::factory();

        return [
            'created_by' => $userFactory,
            'updated_by' => $userFactory,
            'string' => $this->faker->city(),
            'email' => $this->faker->email(),
            'integer' => $this->faker->randomNumber(0),
            'decimal' => $this->faker->randomNumber(1),
            'n_p_w_p' => $this->faker->randomNumber(),
            'datetime' => $this->faker->dateTime(),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'i_p_address' => $this->faker->ipv4(),
            'bool' => $this->faker->boolean(),
            'enum' => 'enabled',
            'text' => $this->faker->text(),
            'markdown_text' => $this->faker->text(),
            'w_y_s_i_w_y_g' => $this->faker->text(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'user_id' => $userFactory,
        ];
    }
}
