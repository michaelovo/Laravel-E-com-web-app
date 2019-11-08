<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Currency;
class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::all();
        //$currencies = Permission::latest()->get();
        $page_title='Currency';
        return view('admin.currencies.add_currency')->with(compact('currencies','page_title'));;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'currency_code'=>'required',
            'exchange_rate'=>'required',
            'country_name'=>'required'

         ]);
      $currencies =new Currency;
      $currencies->currency_code = $request->currency_code;
      $currencies->exchange_rate = $request->exchange_rate;
      $currencies->country_name = $request->country_name;
     // $currencies->save();
             //status check
             if(empty($request->status)){
                $status=0;
            }else{
                $status=1;
            }
       // prevent duplicate
       $currencyCount = Currency::where('currency_code',$request->currency_code)->count();
       if($currencyCount >0){
           return redirect()->back()->with('flash_err_msg','Currency Already Exists!');
       }else{
           $currencies->save();
           return back()->with('flash_success_msg','New Currencies Added successfully!');
         }
      //return redirect('admin.currencies.add_currency')>with('flash_success_msg','Currency created successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewCurrency()
    {
        $currencies = Currency::orderBy('id','ASC')->get();
        $page_title ="currencies";
         return view('admin.currencies.view_currencies')->with(compact('currencies','page_title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
