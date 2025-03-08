<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'foto',
        'no_wa'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public function sekolah(){
        return $this->hasOneThrough(
            Sekolah::class,
            AdminSekolah::class,
            'user_id', // Foreign key on the AdminSekolah table...
            'id', // Foreign key on the Sekolah table...
            'id', // Local key on the User table...
            'sekolah_id' // Local key on the AdminSekolah table...
        );
    }

    public function guru(){
        return $this->hasOne(Guru::class,'user_id','id');
    }

    public function wali(){
        return $this->hasOne(OrangTua::class,'user_id','id');
    }
}
