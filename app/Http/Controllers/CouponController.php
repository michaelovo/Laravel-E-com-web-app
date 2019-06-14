<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;

class CouponController extends Controller
{	
	//INSERT COUPON TO coupons table
	public function addCoupon(Request $request){
		if($request->ismethod('post')){
    		$data=$request->all();
    		//echo "<pre>"; print_r($data); die;
    		$coupon = new Coupon;
        	$coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['amount']; 
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->status = $data['status'];
            $coupon->save();
            return redirect()->action('CouponController@viewCoupons')->with('flash_success_msg','New Coupon Added successfully!');
        }
		return view('admin.coupons.add_coupon');
			  	
	}


    // FUNCTION TO RETRIEVE AND DISPLAY DATA FROM 'coupons' table in DB ON VIEW-COUPONS BLADE FILE
    public function viewCoupons(){
        $coupons = Coupon::orderby('id','asc')->get();
        //To retrieve and display category name from 'categories' table on view_coupons blade files
       // foreach ($coupons as $key => $value) {
       // 	$category_name = Category::where(['id'=>$value->category_id])->first();
        //	$coupons[$key]->category_name = $category_name->name;
        	
       // }
        return view('admin.coupons.view_coupon')->with(compact('coupons'));
    }
    
}
