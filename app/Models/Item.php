<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasOne;

class Item extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'item';
    protected $primaryKey = '_id';
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'ingredients',
        'category_id',
        'status'
    ];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class,'_id','category_id');
    }
}
