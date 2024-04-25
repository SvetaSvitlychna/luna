<?php

namespace Database\Factories;
use App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = \DB::table('users')->pluck('id');
        // $users = Profile::pluck('id');
        return [
            'user_id'=>$this->faker->unique()->randomElement($users),
            'first_name'=>$this->faker->firstName,
            'last_name'=>$this->faker->lastName,
            'phone'=>$this->faker->tollFreePhoneNumber,
            'ip_address'=>$this->faker->ipv4,
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    } 
}
