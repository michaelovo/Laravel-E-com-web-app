<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Start -- Relationship between 'Category' and 'Subcategory'
	public function categories(){
		return $this->hasMany('App\Category','parent_id'); //'parent_id' is the subcategory key
	}
    // Start -- 'Category' and 'Subcategory'
}
