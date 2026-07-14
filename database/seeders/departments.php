<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class departments extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            ['name' => 'HR', 'description' => 'Human Resources', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'IT', 'description' => 'Information Technology', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sales', 'description' => 'Sales and Marketing', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
