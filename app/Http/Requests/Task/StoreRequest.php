<?php

namespace App\Http\Requests\Task;

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
            'title' => ['required', 'string', 'max:255'],
            'due_date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string', 'in:done,pending,on-progress,todo'],
            'assigned_to' => ['required', 'exists:employees,id'],
        ];
    }
}
