<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponController extends Controller
{
	public function addCoupon(Request $request){
		return view('admin.coupons.add_coupon');
	}
    //
}
