<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Psychic;
use Illuminate\Database\Eloquent\Factories\Factory;

class PsychicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Psychic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
                'name' => $this->faker->name(),
        ];
    }
}
