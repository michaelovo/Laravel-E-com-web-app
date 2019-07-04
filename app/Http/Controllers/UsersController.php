<?php

namespace App\Http\Controllers;

use App\User;
use App\Country;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;

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
      //Session::flush();
      return redirect('/');
    }
    // End -- logout function

    public function account(Request $request){
    	$user_id = Auth::user()->id; // get auth user id
    	$userDetails = User::find($user_id); //get user details
    	//echo "<pre>"; print_r($userDetails); die;
    	$countries = Country::get();// get all countries from 'countries' table

    	if($request->ismethod('post')){
	        $data=$request->all();

	        $user = User::find($user_id);
    		$user->name = $data['name'];
    		$user->address = $data['address'];
    		$user->city = $data['city'];
    		$user->state = $data['state'];
    		$user->country = $data['country'];
    		$user->pincode = $data['pincode'];
    		$user->mobile = $data['mobile'];
    		$user->save();
    		 return redirect()->back()->with('flash_success_msg','Account details has been Successfully Updated!');
	    }
    	return view('users.account')->with(compact('countries','userDetails'));
    }

    // Starts -- current password validation
    public function chkUserPwd(Request $request){
      $data = $request->all();
      $current_password=$data['current_pwd'];
      $user_id = Auth::user()->id;
      $check_password = User::where('id',$user_id)->first();
      if(Hash::check($current_password,$check_password->password)){
        echo "true"; die;
        }
        else{
          echo "false"; die;
        }
    }
    // Ends -- current password validation

    // Starts -- Update User password
    public function updateUserPwd(Request $request){
      if($request->ismethod('post')){

      $data = $request->all();  
      $old_password = User::where('id',Auth::User()->id)->first();
      $current_password=$data['current_pwd'];
      if(Hash::check($current_password,$old_password->password)){
      	//update password
        $new_pwd = bcrypt($data['new_pwd']);
        User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
         return redirect()->back()->with('flash_success_msg','Password update successfull');
        }
        else{
        
            return redirect()->back()->with('flash_err_msg','Current password is Incorrect.Fail to update password!');
        }
      }
    }
    // Ends -- Update User password
}
