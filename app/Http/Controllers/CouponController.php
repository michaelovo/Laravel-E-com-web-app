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
        return view('admin.coupons.view_coupon')->with(compact('coupons'));
    }


      // EDIT/ UPDATE COUPON FUNCTION
    public function  editCoupon(Request $request,$id=null){
    	// update edited coupon data by id
    	if($request->ismethod('post')){
    		$data=$request->all();
    		$coupon = Coupon::find($id);
        	$coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['amount']; 
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];

            //status check
            if(empty($data['status'])){
                $data['status']=0;
            }
            $coupon->status = $data['status'];
            $coupon->update();
            return redirect()->action('CouponController@viewCoupons')->with('flash_success_msg','Coupon Updated successfully!');
        }

    	// get coupon data for edit by id
        $couponDetails = Coupon::find($id);
        return view('admin.coupons.edit_coupon')->with(compact('couponDetails'));
    }
    
}
