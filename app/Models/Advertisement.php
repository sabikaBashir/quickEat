<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Advertisement extends Model
{    
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'advertisment';
    protected $fillable = [
        'heading',
        'description',
        'image',
        'status',
        'added_by'
    ];
}
