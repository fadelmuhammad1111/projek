<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke Reports
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    // Relasi ke Comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relasi ke StaffProvinces
    public function staffProvinces()
    {
        return $this->hasMany(StaffProvince::class);
    }

    // Relasi ke Responses sebagai staff
    public function responses()
    {
        return $this->hasMany(Response::class, 'staff_id');
    }
}
