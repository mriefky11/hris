<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Carbon\Carbon;

class attendances extends Seeder
{
    public function run(): void
    {
        $employees = Employee::take(2)->get();

        foreach ($employees as $index => $employee) {

            $date = '2025-02-10';

            \App\Models\Attendance::create([
                'employee_id' => $employee->id,
                'date' => $date,

                'check_in_time' => Carbon::parse($date . ' 09:00:00')->addMinutes($index * 15),
                'check_in_lat' => -6.2000000,
                'check_in_lng' => 106.8166667,
                'check_in_photo' => 'attendance/checkin-' . ($index + 1) . '.jpg',

                'check_out_time' => Carbon::parse($date . ' 17:00:00')->addMinutes($index * 5),
                'check_out_lat' => -6.2000000,
                'check_out_lng' => 106.8166667,
                'check_out_photo' => 'attendance/checkout-' . ($index + 1) . '.jpg',

                'status' => 'present',
            ]);
        }
    }
}
