<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function register(Request $request){
    	if($request->ismethod('post')){
    		$data=$request->all();
    		//echo "<pre>"; print_r($data); die;

    		//php:check if user already exists with dsame email i.e email should be unique
    		$usersCount = User::where('email',$data['email'])->count();
    		if($usersCount >0){
    			return redirect()->back()->with('flash_err_msg','Email already exist!');
    		}
	    }	
    	return view('users.login_register');
    }

    //Using jqquery remote function to check uniqueness of user email
    public function checkEmail(Request $request){
    	//Jquery remote function:check if user already exists with dsame email i.e email should be unique
    	$data=$request->all();
	   	$usersCount = User::where('email',$data['email'])->count();
	    if($usersCount >0){
	    	echo "false";die;
	    }else{
	    	echo "true";die;
	    }
    }
}
