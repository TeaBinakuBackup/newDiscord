<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Initialize Faker
        $faker = Faker::create();

        // Create 10 users with fake data
        foreach (range(1, 10) as $index) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'avatar' => 'avatars/' . $faker->word . '.png',  // Fake avatar path
                'email_verified_at' => now(),
                'password' => Hash::make('password'),  // Default password for all
                'user_type_id' => 1,  // Random user type
                'mood_status_id' => 1,  // Random mood status
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
