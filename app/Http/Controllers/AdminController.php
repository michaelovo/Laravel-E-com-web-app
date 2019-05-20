<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    //
    public function login(Request $request){
      if($request->ismethod('post')){
        $data=$request->input();
        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
          echo "succes";die;
        }
        else{
          echo "failed";die;
        }
      }
      return view('admin.admin_login');
    }
}
