<?php

namespace Database\Factories;

use App\Models\Record;
use App\Models\Subrecord;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubrecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subrecord::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'datetime' => $this->faker->dateTime(),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'n_p_w_p' => $this->faker->randomNumber(),
            'markdown_text' => $this->faker->text(),
            'w_y_s_i_w_y_g' => $this->faker->text(),
            'i_p_address' => $this->faker->ipv4(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'record_id' => Record::factory(),
        ];
    }
}
