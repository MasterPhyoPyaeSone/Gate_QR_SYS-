<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'staff_id',
        'position',
        'gender',
        'ph_no',
        'image',
        'qr_image'
    ];

    public function entry_data(){
        return $this->hasMany(Entry_Data::class, 'user_id', 'staff_id');
    }

    public static function scopeFilter($TeachersQuery,$filters=[]){
        // dd($filters['name']);

        if($filter=$filters['name'] ?? null){
            $TeachersQuery->where(function($query) use ($filter){
                $query->where('name','LIKE','%'.$filter.'%');
                     
            });
        }
        if($filter=$filters['staff_id'] ?? null){
            $TeachersQuery->where(function($query) use ($filter){
                $query->where('staff_id','LIKE','%'.$filter.'%');
                     
            });
        }
        if($filter=$filters['position'] ?? null){
            $TeachersQuery->where(function($query) use ($filter){
                $query->where('position','LIKE','%'.$filter.'%');
                     
            });
        }
       
    }
}
