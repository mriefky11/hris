<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['title' => 'Manager', 'description' => 'Handles team management', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Developer', 'description' => 'Handles software development', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Salesperson', 'description' => 'Handles sales and client communication', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
