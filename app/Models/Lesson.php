<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    // Nếu tên bảng không theo quy tắc số nhiều, chỉ định tên bảng
    protected $table = 'lessons'; 

    protected $fillable = ['title', 'description'];
}
