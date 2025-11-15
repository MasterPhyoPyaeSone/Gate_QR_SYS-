<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'email',
        'teacher_id',
        'position',
        'department',
        'gender',
        'ph_no',
        'image',
        'qr_image'
    ];
    public function entry_data(){
        return $this->hasMany(Entry_Data::class, 'user_id', 'teacher_id');
    }

    public static function scopeFilter($TeachersQuery,$filters=[]){
        // dd($filters['name']);

        if($filter=$filters['name'] ?? null){
            $TeachersQuery->where(function($query) use ($filter){
                $query->where('name','LIKE','%'.$filter.'%');
                     
            });
        }
        if($filter=$filters['teacher_id'] ?? null){
            $TeachersQuery->where(function($query) use ($filter){
                $query->where('teacher_id','LIKE','%'.$filter.'%');
                     
            });
        }
        if($filter=$filters['position'] ?? null){
            $TeachersQuery->where(function($query) use ($filter){
                $query->where('position','LIKE','%'.$filter.'%');
                     
            });
        }
        if($filter=$filters['department'] ?? null){
            $TeachersQuery->where(function($query) use ($filter){
                $query->where('department','LIKE','%'.$filter.'%');
                     
            });
        }
    }
}
