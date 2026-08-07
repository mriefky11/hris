<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'employee_id',
        'date',
        'check_in_time',
        'check_out_time',
        'check_in_photo',
        'check_out_photo',
        'check_in_lat',
        'check_in_lng',
        'check_out_lat',
        'check_out_lng',
        'status',
    ];

    /**
     * CASTS
     */
    protected $casts = [
        'date' => 'date:Y-m-d',
        'check_in_time' => 'datetime:H:i',
        'check_out_time' => 'datetime:H:i',
    ];

    /**
     * RELATION
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * ACCESSOR (FORMATTING)
     */
    public function getCheckInTimeFormattedAttribute()
    {
        return $this->check_in_time
            ? Carbon::parse($this->check_in_time)->format('H:i')
            : '-';
    }

    public function getCheckOutTimeFormattedAttribute()
    {
        return $this->check_out_time
            ? Carbon::parse($this->check_out_time)->format('H:i')
            : '-';
    }

    public function getDateFormattedAttribute()
    {
        return Carbon::parse($this->date)->format('d M Y');
    }

    public function getStatusLabelAttribute()
    {
        if (!$this->check_out_time) {
            return 'On Going';
        }

        return 'Completed';
    }
}
