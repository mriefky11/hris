<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use carbon\Carbon;
use Illuminate\Support\Facades\DB;

class leaves extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('leaves')->insert([
            [
                'employee_id' => 1, // John Doe
                'leave_type' => 'Sick Leave',
                'start_date' => Carbon::parse('2025-02-12'),
                'end_date' => Carbon::parse('2025-02-12'),
                'status' => 'approved',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 2, // Jane Smith
                'leave_type' => 'Vacation',
                'start_date' => Carbon::parse('2025-02-15'),
                'end_date' => Carbon::parse('2025-02-18'),
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
