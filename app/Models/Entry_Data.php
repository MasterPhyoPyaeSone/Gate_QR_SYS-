<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Entry_Data extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'state',
    ];
    protected $casts = [
        'time' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Students::class, 'user_id', 'roll_number');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'user_id', 'teacher_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'user_id', 'staff_id');
    }

    public static function scopeFilter($Query, $filters = [])
    {
        // dd($filters=['date']);
        // $startDateTime = Carbon::parse($date . ' ' . $filters['S_time']);
        // $endDateTime   = Carbon::parse($date . ' ' . $filters['E_time']);

        // dd($startDateTime);

        if ($filter = $filters['name'] ?? null) {
            $Query->where(function ($query) use ($filter) {
                $query->where('name', 'LIKE', '%' . $filter . '%');
            });
        }
        if ($filter = $filters['user_id'] ?? null) {
            $Query->where(function ($query) use ($filter) {
                $query->where('user_id', 'LIKE', '%' . $filter . '%');
            });
        }
        if ($filter = $filters['state'] ?? null) {
            $Query->where(function ($query) use ($filter) {
                $query->where('state', 'LIKE', '%' . $filter . '%');
            });
        }
        if ($filter = $filters['date'] ?? null) {
            $Query->where(function ($query) use ($filter) {
                $query->where('time', 'LIKE', '%' . $filter . '%');
            });
        }


        $filter1 = $filters['S_time'] ?? null; // Start time
        $filter2 = $filters['E_time'] ?? null; // End time
        if ($filter1 && $filter2) { // Check if both filters are not null
            $date = $filters['date']; // Get the date from filters
            $Query->where(function ($query) use ($filter1, $filter2, $date) {
                // Parse the start and end date-time
                $startDateTime = Carbon::parse($date . ' ' . $filter1);
                $endDateTime = Carbon::parse($date . ' ' . $filter2);
                // Apply the whereBetween condition
                $query->whereBetween('time', [$startDateTime, $endDateTime]);
            });
        }
        // if ($filter1 = $filters['S_time'] ?? null && $filter2= $filters['E_time'] ?? null) {
        //     $date = $filters['date'];
        //     $Query->where(function ($query) use ($filter1 , $filter2 , $date) {
        //         $startDateTime = Carbon::parse($date . ' ' . $filter1);
        //         $endDateTime   = Carbon::parse($date . ' ' . $filter2);
        //         $query->whereBetween('time', [$startDateTime, $endDateTime]);
        //     });
        // }


        // Query
        // $data = Student::whereBetween('time', [$startDateTime, $endDateTime])->get();

    }
}
