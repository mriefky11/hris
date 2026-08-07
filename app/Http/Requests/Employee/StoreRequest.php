<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fullname' => ['required', 'string'],
            'email' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'address' => ['required', 'string'],
            'birth_date' => ['required', 'date'],
            'hire_date' => ['required', 'date'],
            'department_id' => ['required', 'exists:departments,id'],
            'role_id' => ['required', 'exists:roles,id'],
            'status' => ['required', 'string', 'in:active,inactive'],
            'salary' => ['required', 'numeric'],
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }
}
