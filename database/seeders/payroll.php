<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use carbon\Carbon;
use Illuminate\Support\Facades\DB;
use faker\Factory as Faker;

class payroll extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        DB::table('payroll')->insert([
            [
                'employee_id' => 1, // John Doe
                'salary' => $faker->randomFloat(2, 4000, 6000),
                'bonuses' => $faker->randomFloat(2, 100, 500),
                'deductions' => $faker->randomFloat(2, 50, 200),
                'net_salary' => $faker->randomFloat(2, 4000, 6000),
                'pay_date' => Carbon::parse('2025-02-01'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 2, // Jane Smith
                'salary' => $faker->randomFloat(2, 4000, 7000),
                'bonuses' => $faker->randomFloat(2, 100, 500),
                'deductions' => $faker->randomFloat(2, 50, 200),
                'net_salary' => $faker->randomFloat(2, 4000, 7000),
                'pay_date' => Carbon::parse('2025-02-01'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
