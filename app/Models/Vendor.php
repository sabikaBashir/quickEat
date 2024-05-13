<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'vendor';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
