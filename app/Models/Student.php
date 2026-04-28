<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // YOU MUST ADD THIS SECTION TO SAVE DATA!
    protected $fillable = [
        'student_name',
        'parent_name',
        'age',
        'program',
        'phone',
        'email'
    ];
}