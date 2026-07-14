<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'tasks';

    protected $casts = [
        'due_date' => 'datetime',
    ];

    protected $fillable = [
        'title',
        'description',
        'assigned_to',
        'due_date',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }

    public function getDueDateFormattedAttribute()
    {
        return $this->due_date?->format('d F Y H:i');
    }
}
