<?php

namespace Database\Factories;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description'=> $this->faker->sentence($nbWords =6, $variableNbWords = true),
            'votes'=>$this->faker->randomDigit,
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
