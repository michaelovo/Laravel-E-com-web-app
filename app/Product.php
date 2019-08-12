<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
use DB;

class Product extends Model
{
	// Start -- Relationship between 'Product' and 'ProductsAtrribute'
	public function attributes(){
		return $this->hasMany('App\ProductsAttribute','product_id'); //'product_id' is the attribute key
	}
    // Start -- Relationship between 'Product' and 'ProductsAtrribute'

		// Function to count/displays quantity of items in the user shopping cart
		public static function cartCount(){
			if(Auth::check()){
				//If user is logged in, use Auth email
				$user_email =Auth::user()->email;
				$cartCount =DB::table('cart')->where('user_email',$user_email)->sum('quantity');

			}else{
				//if user not logged in , user sessionid
				$session_id = Session::get('session_id');
				$cartCount =DB::table('cart')->where('session_id',$session_id)->sum('quantity');
			}
			return $cartCount;
		}

		//function to display the available products and subcategory quantity on the sidebar and when searched for product
		public static function productCount($cat_id){
			$catCount = Product::where(['category_id'=>$cat_id,'status'=>1])->count();
			return $catCount;
		}
}
