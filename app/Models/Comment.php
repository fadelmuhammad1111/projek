<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'user_id',
        'content',
        'comments',
    ];

    // Relasi ke Report
    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id'); // Ensure the correct foreign key is used
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
