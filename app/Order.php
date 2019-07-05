<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	// Start -- Relationship between 'Orders' and 'Orders_products' table
	public function orders(){
		return $this->hasMany('App\OrdersProduct','order_id'); //'order_id' is the key we are using in Orders_products table
	}
    // End -- Relationship between 'Orders' and 'Orders_products' table
}
