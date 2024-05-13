<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'student';
    protected $primaryKey = '_id';
    protected $fillable = [
        'student_id',
        'name',
        'email',
        'password',
        'image'
    ];
}
