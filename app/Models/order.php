<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;
use MongoDB\Laravel\Relations\HasOne;

class order extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'order';
    protected $primaryKey = '_id';
    protected $fillable = [
        'order_id',
        'student_id',
        'price',
        'category_id',
        'status',
        'reason',
        'pickup_date',
        'order_date'
    ];

    public function orderDetail(): HasMany
    {
        return $this->HasMany(OrderDetail::class);
    }

    public function studentDetail(): HasOne
    {
        return $this->HasOne(Student::class,'student_id','student_id');
    }
}
