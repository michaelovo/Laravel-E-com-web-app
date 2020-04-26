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

	public static function getcurrencyRate($price){
		$currencies = Currency::where('status',1)->get();
		foreach ($currencies as $currency){
			if($currency->currency_code=="USD"){
				$USD_rates =round($price/$currency->exchange_rate,2);
			}
			elseif($currency->currency_code=="EUR"){
				$EUR_rates =round($price/$currency->exchange_rate,2);
			}
			if($currency->currency_code=="GHC"){
				$GHC_rates =round($price/$currency->exchange_rate,2);
			}
			if($currency->currency_code=="ZAR"){
				$ZAR_rates =round($price/$currency->exchange_rate,2);
			}
			if($currency->currency_code=="XOF"){
				$XOF_rates =round($price/$currency->exchange_rate,2);
			}
		} 
		$currenciesArr=array(
			'USD_rates'=>$USD_rates,
			'EUR_rates'=>$EUR_rates,
			'GHC_rates'=>$GHC_rates,
			'ZAR_rates'=>$ZAR_rates,
			'XOF_rates'=>$XOF_rates
		);
		return $currenciesArr;
	}

	//get current product stock
	public static function getProductStock($product_id, $product_size){
		$getProductStock = ProductsAttribute::select('stock')->where(['product_id'=>$product_id,'size'=>$product_size])->first();
		return $getProductStock->stock;
	}

	// remove sold out product from user's cart
	public static function removeSoldOutFromCart($product_id,$user_mail){
		$removeFromCart = DB::table('cart')->where([
			['product_id',$product_id],
			['user_email',$user_mail]
			])->delete();
		return $removeFromCart;
	}
}
