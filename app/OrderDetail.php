<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    public function product() {
        return $this->hasMany('App\Product', 'id', 'product_id')->firstOrFail();
    }
}
