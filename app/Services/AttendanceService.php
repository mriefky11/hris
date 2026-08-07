<?php

namespace App\Services;

use App\Repositories\AttendanceRepository;
use Illuminate\Support\Facades\Storage;

class AttendanceService
{
    protected $attendanceRepo;

    public function __construct(AttendanceRepository $attendanceRepo)
    {
        $this->attendanceRepo = $attendanceRepo;
    }

    public function getAllByEmployee($employeeId)
    {
        return $this->attendanceRepo->getByEmployee($employeeId);
    }

    public function getAll()
    {
        return $this->attendanceRepo->getAll();
    }

    public function checkIn($employeeId, $data)
    {
        $existing = $this->attendanceRepo->findToday($employeeId);

        if ($existing) {
            throw new \Exception('Anda sudah melakukan check-in hari ini.');
        }

        $photoPath = ! empty($data['photo'])
            ? $this->storePhoto($data['photo'], 'checkin')
            : null;

        $checkInTime = now();
        $status = $checkInTime->format('H:i') > '09:00' ? 'late' : 'present';

        return $this->attendanceRepo->create([
            'employee_id' => $employeeId,
            'date' => today(),
            'check_in_time' => $checkInTime,
            'check_in_lat' => $data['latitude'],
            'check_in_lng' => $data['longitude'],
            'check_in_photo' => $photoPath,
            'status' => $status,
        ]);
    }

    public function checkOut($employeeId, $data)
    {
        $attendance = $this->attendanceRepo->findToday($employeeId);

        if (! $attendance) {
            throw new \Exception('Anda belum melakukan check-in hari ini.');
        }

        if ($attendance->check_out_time) {
            throw new \Exception('Anda sudah melakukan check-out hari ini.');
        }

        $photoPath = ! empty($data['photo'])
            ? $this->storePhoto($data['photo'], 'checkout')
            : null;

        return $this->attendanceRepo->update($attendance->id, [
            'check_out_time' => now(),
            'check_out_lat' => $data['latitude'],
            'check_out_lng' => $data['longitude'],
            'check_out_photo' => $photoPath,
        ]);
    }

    public function findById($id)
    {
        return $this->attendanceRepo->find($id);
    }

    private function storePhoto($base64, $type)
    {
        $image = preg_replace('/^data:image\/\w+;base64,/', '', $base64);
        $image = base64_decode($image);

        $fileName = "attendance/{$type}-".time().'.png';

        Storage::disk('public')->put($fileName, $image);

        return $fileName;
    }

    public function getToday($employeeId)
    {
        return $this->attendanceRepo->findToday($employeeId);
    }
}
