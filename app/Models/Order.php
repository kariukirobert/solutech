<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['order_number'];

    public function scopeGenerateOrderNumber()
    {
        $number = mt_rand(100000000, 999999999);

        if (Order::where('order_number', $number)->exists()) {
            return $this->generateOrderNumber();
        }

        return $number;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
