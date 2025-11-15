<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Students extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'roll_number',
        'year',
        'major',
        'gender',
        'ph_no',
        'image',
        'qr_image'
    ];

    public function entry_data(){
        return $this->hasMany(Entry_Data::class, 'user_id', 'roll_number');
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
