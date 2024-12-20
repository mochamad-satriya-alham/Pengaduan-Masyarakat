<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
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
        'image',
        'statement',
        'viewers',
        'status',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'report_id');  // Menghubungkan Report dengan Comment menggunakan report_id
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
