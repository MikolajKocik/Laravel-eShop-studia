<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total_price', 'status', 'product_id'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
