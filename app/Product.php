<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	// Start -- Relationship between 'Product' and 'ProductsAtrribute'
	public function attributes(){
		return $this->hasMany('App\ProductsAttribute','product_id'); //'product_id' is the attribute key
	}
    // Start -- Relationship between 'Product' and 'ProductsAtrribute'
}
