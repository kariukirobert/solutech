<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'quantity'];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details');
    }

    public function supplier()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_products', 'product_id', 'supply_id');
    }
}
