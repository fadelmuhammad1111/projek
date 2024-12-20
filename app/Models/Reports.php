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
        'checkbox',
    ];

    protected $casts = [
        'voting' => 'array',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'report_id'); // Ensure the correct foreign key is used
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    
}
