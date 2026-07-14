<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use carbon\Carbon;
use Illuminate\Support\Facades\DB;

class attendances extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attendances')->insert([
            [
                'employee_id' => 1, // John Doe
                'check_in' => Carbon::parse('2025-02-10 09:00:00'),
                'check_out' => Carbon::parse('2025-02-10 17:00:00'),
                'date' => Carbon::parse('2025-02-10'),
                'status' => 'present',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 2, // Jane Smith
                'check_in' => Carbon::parse('2025-02-10 09:15:00'),
                'check_out' => Carbon::parse('2025-02-10 17:00:00'),
                'date' => Carbon::parse('2025-02-10'),
                'status' => 'present',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
