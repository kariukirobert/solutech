<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['order_number'];

    public function scopeGenerateOrderNumber()
    {
        $number = mt_rand(100000000, 999999999);

        if (Order::whereCode($number)->exists()) {
            return $this->generateOrderNumber();
        }

        return $number;
    }
}
