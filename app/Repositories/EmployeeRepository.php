<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeRepository
{
    public function all()
    {
        return Employee::with(['department', 'role', 'user'])->get();
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $password = $data['password'] ?? 'password';
            unset($data['password']);

            $user = User::create([
                'name' => $data['fullname'],
                'email' => $data['email'],
                'password' => Hash::make($password),
                'role' => 'employee',
            ]);

            $data['user_id'] = $user->id;

            return Employee::create($data);
        });
    }

    public function findOrFail($id)
    {
        return Employee::with(['department', 'role', 'user'])->findOrFail($id);
    }

    public function update(Employee $employee, array $data)
    {
        return DB::transaction(function () use ($employee, $data) {
            if (! empty($data['password']) && $employee->user) {
                $employee->user->update(['password' => Hash::make($data['password'])]);
            }
            unset($data['password']);

            if ($employee->user) {
                $employee->user->update([
                    'name' => $data['fullname'] ?? $employee->fullname,
                    'email' => $data['email'] ?? $employee->email,
                ]);
            }

            $employee->update($data);

            return $employee->fresh(['department', 'role', 'user']);
        });
    }

    public function destroy(Employee $employee)
    {
        return DB::transaction(function () use ($employee) {
            $user = $employee->user;
            $employee->delete();

            if ($user) {
                $user->delete();
            }

            return true;
        });
    }
}
