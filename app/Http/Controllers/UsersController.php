<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Session;
//use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UsersController extends Controller
{
	// return user to login_register blade file
    public function userLoginRegister(){
    	return view('users.login_register');
    }

    // Add user : user register function
    public function register(Request $request){
    	if($request->isMethod('post')){
    		$data=$request->all();
    		//echo "<pre>"; print_r($data); die;

    		//php:check if user already exists with dsame email i.e email should be unique
    		$usersCount = User::where('email',$data['email'])->count();
    		if($usersCount >0){
    			return redirect()->back()->with('flash_err_msg','Email already exist!');
    		}else{
    			$user = new User;
    			$user->name = $data['name'];
    			$user->email = $data['email'];
    			$user->password = bcrypt($data['password']); //bcrypt user password for security
    			$user->save();
    			if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
    				Session::put('frontSession',$data['email']); //start 'frontSession' whenever a user registers
    				return redirect('/cart');
    			}
    		}
	    }	
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
    
    //login function
    public function login(Request $request){
    	if($request->ismethod('post')){
	        $data=$request->input();
	        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
	        	Session::put('frontSession',$data['email']); //start 'frontSession' whenever a user login
	 	        return redirect('/cart');
	        }
	        else{
	            return redirect()->back()->with('flash_err_msg','Invalid login credentials');
	        }
	    }
    }
    // Start -- logout function
    public function logout(){
      Auth::logout();
      Session::forget('frontSession');
      return redirect('/');
    }
    // End -- logout function


    public function account(){
    	return view('users.account');
    }

}
