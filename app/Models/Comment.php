<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['report_id', 'user_id', 'comment',];

    // Relasi ke model Report
    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');  // Menghubungkan Comment dengan Report menggunakan report_id
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Relasi ke model User
    }


}
