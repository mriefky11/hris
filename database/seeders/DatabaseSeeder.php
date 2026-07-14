<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'employee_id' => '1'
        ]);

        $this->call(
            [
                departments::class,
                roles::class,
                employees::class,
                attendances::class,
                tasks::class,
                payroll::class,
                leaves::class
            ]
        );
    }
}
