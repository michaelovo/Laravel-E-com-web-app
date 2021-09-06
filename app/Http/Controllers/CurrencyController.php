<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Currency;
class CurrencyController extends Controller
{
    
    public function index()
    {
        $currencies = Currency::all();
        $page_title='Add Currency';
        return view('admin.currencies.add_currency')->with(compact('currencies','page_title'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'currency_code'=>'required',
            'exchange_rate'=>'required',
            'country_name'=>'required |unique:currencies'

        ]);
        $currencies =new Currency;
        $currencies->currency_code = $request->currency_code;
        $currencies->exchange_rate = $request->exchange_rate;
        $currencies->country_name = $request->country_name;

        if(empty($request->status)){
            $status=0;
        }else{
            $status=1;
        }

        $currencies->save();
        return back()->with('flash_success_msg','New Currencies Added successfully!');
    }
   
    public function viewCurrency()
    {
        $currencies = Currency::orderBy('updated_at','DESC')->latest()->get();
        $page_title ="Currencies";
         return view('admin.currencies.view_currencies')->with(compact('currencies','page_title'));
    }
   
    public function editCurrency($id)
    {
        $currency = Currency::findOrFail($id);
        $page_title='Update Currency';
        return view('admin.currencies.edit_currency')->with(compact('currency','page_title'));
    }

    public function updateCurrency(Request $request, $id)
    {
        $this->validate($request,[
            'currency_code'=>'required',
            'exchange_rate'=>'required',
            'country_name'=>'required'

         ]);

        $currency = Currency::findOrFail($id);
        $currency->currency_code = $request->currency_code;
        $currency->exchange_rate = $request->exchange_rate;
        $currency->country_name = $request->country_name;

         if(empty($currency->status=$request->status)){
            $status=0;
        }else{
            $status=1;
        }
        $currency->update();
       return redirect('/admin/view_currencies')->with('flash_success_msg','Currency Updated successfully!');
    }

    public function deleteCurrency($id)
    {
        $currency = Currency::findOrFail($id);
        $currency->delete();
        return redirect()->back()->with('flash_success_msg', 'Operation successfully!');

    }
}
