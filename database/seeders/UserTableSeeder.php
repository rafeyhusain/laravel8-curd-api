<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
          User::create([
                'first_name' => $faker->firstNameMale,
                'last_name' => $faker->lastName,
                'middle_name' => $faker->lastName,
                'username' => $faker->username,
                'date_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now')
            ]);
        }
    }
}
