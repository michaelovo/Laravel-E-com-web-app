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
            return redirect()->back()->with('flash_success_msg','New Coupont Added successfully!');
        }
		return view('admin.coupons.add_coupon');
			  	
	}
    
}
