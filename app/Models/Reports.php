<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'type',
        'province',
        'regency',
        'subdistrict',
        'village',
        'voting',
        'viewers',
        'image',
        'statement',
    ];

    protected $casts = [
        'voting' => 'array',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Comments
    // public function comments()
    // {
    //     return $this->hasMany(Comment::class, 'report_id');
    // }

    // Relasi ke Responses
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
