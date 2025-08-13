<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // or Hash::make('password')
            'image' => null, // Assuming nullable
            'role' => 'admin',
            'status' => 'approved',
            'email_verified' => 1,
            'activation_token' => Str::random(60),
            'remember_token' => Str::random(10),
        ];
    }

    // State for orphanage managers
    public function orphanageManager()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'orphanagemanager',
                'username' => 'manager_'.Str::random(8), // Unique manager username
            ];
        });
    }

    // State for unverified admins
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified' => 0,
                'activation_token' => Str::random(60),
            ];
        });
    }

    // State for super admins
    public function superAdmin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'Super Admin',
                'username' => 'super_'.Str::random(6),
            ];
        });
    }

    // State for pending approval
    public function pending()
    {
        return $this->state([
            'status' => 'pending',
        ]);
    }
}
