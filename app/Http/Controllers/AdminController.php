<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Session;

class AdminController extends Controller
{
    //
    public function login(Request $request){
      if($request->ismethod('post')){
        $data=$request->input();
        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
        //  echo "succes";die;
        //Session::put('adminSession',$data['email']);
        return redirect('/admin/dashboard');
        }
        else{
          //echo "failed";die;
            return redirect('/admin')->with('flash_err_msg','Invalid login credentials');
        }
      }
      return view('admin.admin_login');
    }

    public function dashboard(){
      //if(Session::has('adminSession')){
        //perform all dashboard rask
    //  }
    //  else{
    //      return redirect('/admin')->with('flash_err_msg','Please login to access...');
    //  }
      return view('admin.dashboard');
    }

    public function logout(){
      Session::flush();
      return redirect('/admin')->with('flash_success_msg','logout successfull');
    }

    public function settings(){
        return view('admin.settings');
    }
}
