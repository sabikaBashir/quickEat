<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class orderDetail extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'orderDetail';
    protected $primaryKey = '_id';
    protected $fillable = [
        'order_id',
        'item_price',
        'category_id',
        'item_name',
        'item_qty',
        'item_img',
    ];
}
