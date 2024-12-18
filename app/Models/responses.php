<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'response_status',
        'staff_id',
    ];

    // Relasi ke Report
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    // Relasi ke User (staff yang memberikan respons)
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    // Relasi ke ResponseProgress
    public function progress()
    {
        return $this->hasOne(ResponseProgress::class);
    }
}
