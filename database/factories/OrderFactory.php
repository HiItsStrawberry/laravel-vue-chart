<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(2, 1, 100),
            'isCancelled' => $this->faker->boolean(),
            'created_at' => $this->faker->dateTimeThisYear('+8 months')
        ];
    }
}
