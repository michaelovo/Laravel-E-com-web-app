<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShippingCharge;


class ShippingChargeController extends Controller
{
    public function index(){
        $page_title='Add Charges';
        return view('admin.shipping.add_charges',compact('page_title'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'charges'=>'required',
            'country'=>'required |unique:shipping_charges'

        ]);

        $Shippingcharges =new ShippingCharge;
        $Shippingcharges->shipping_charges = $request->charges;
        $Shippingcharges->country = $request->country;

        if(empty($request->status)){
            $status=0;
        }else{
            $status=1;
        }

        $Shippingcharges->save();
        return back()->with('flash_success_msg','New Charges Added successfully!');

    }

    public function viewCharges(){
        $shippingCharges = ShippingCharge::orderBy('updated_at','DESC')->latest()->get();
        $page_title ="Shipping charges";
        return view('admin.shipping.view_charges',compact('shippingCharges','page_title'));
    }

    public function editCharges($id){
        $charge = ShippingCharge::findOrFail($id);
        $page_title='Update Charges';
        return view('admin.shipping.edit_charges',compact('charge','page_title'));

    }

    public function updateCharges(Request $request, $id){
        $this->validate($request,[
            'charges'=>'required',
            'country'=>'required'
        ]);

        $Shippingcharges = ShippingCharge::findOrFail($id);
        $Shippingcharges->shipping_charges = $request->charges;
        $Shippingcharges->country = $request->country;

        if(empty($Shippingcharges->status=$request->status)){
            $status=0;
        }else{
            $status=1;
        }
        $Shippingcharges->update();
        return redirect('/admin/view_charges')->with('flash_success_msg','Charges Updated successfully!');
    }

    public function deleteCharges(){
        $charges = ShippingCharge::findOrFail($id);
        $charges->delete();
        return redirect()->back()->with('flash_success_msg', 'Operation successfully!');
    }
}
