<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'purpose', 'qr_token', 'used','ph_no'];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->qr_token = 'QR-' . Str::uuid(); // unique UUID with "qr-" prefix
        });
    }
    public function guest_entry_data(){
        return $this->hasMany(Entry_Guest_Data::class, 'qr_token', 'qr_token');
    }

    public static function scopeFilter($StudentsQuery,$filters=[]){
        // dd($filters['name']);

        if($filter=$filters['name'] ?? null){
            $StudentsQuery->where(function($query) use ($filter){
                $query->where('name','LIKE','%'.$filter.'%');
                     
            });
        }
        if($filter=$filters['roll_number'] ?? null){
            $StudentsQuery->where(function($query) use ($filter){
                $query->where('roll_number','LIKE','%'.$filter.'%');
                     
            });
        }
        if($filter=$filters['major'] ?? null){
            $StudentsQuery->where(function($query) use ($filter){
                $query->where('major','LIKE','%'.$filter.'%');
                     
            });
        }
        if($filter=$filters['year'] ?? null){
            $StudentsQuery->where(function($query) use ($filter){
                $query->where('year','LIKE','%'.$filter.'%');
                     
            });
        }
    }
}
