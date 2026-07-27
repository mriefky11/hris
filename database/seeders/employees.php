<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class employees extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {

            // 1. buat user
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
            ]);

            // 2. buat employee (link ke user)
            Employee::create([
                'user_id' => $user->id,
                'fullname' => $user->name,
                'email' => $user->email,
                'phone_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'birth_date' => $faker->dateTimeBetween('-40 years', '-20 years'),
                'hire_date' => now(),
                'department_id' => rand(1, 2),
                'role_id' => rand(1, 2),
                'status' => 'active',
                'salary' => $faker->randomFloat(2, 3000, 7000),
            ]);
        }
    }
}
