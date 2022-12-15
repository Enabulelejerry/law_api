<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HeadtypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => 'Odion',
            'last_name' =>'Me',
            'email' => $this->faker->unique()->safeEmail(),
            'title' =>'Head Judge',
            // 'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            
        ];
    }
}
