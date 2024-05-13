<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'category';
    Protected $primaryKey = '_id';
    protected $fillable = [
        'name',
    ];

    public function item(): HasMany
    {
        return $this->HasMany(Item::class);
    }
}
