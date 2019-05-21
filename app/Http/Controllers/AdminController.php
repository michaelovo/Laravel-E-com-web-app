<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function login(Request $request){
      if($request->ismethod('post')){
        $data=$request->input();
        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
        //  echo "succes";die;
        /*
        * This protects admin route using 'Session' approach
        //Session::put('adminSession',$data['email']);
        */
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
      /*
      * This protects admin route using 'Session' approach
      //if(Session::has('adminSession')){
        //perform all dashboard rask
    //  }
    //  else{
    //      return redirect('/admin')->with('flash_err_msg','Please login to access...');
    //  }
    */
      return view('admin.dashboard');
    }
// Start -- logout function
    public function logout(){
      Session::flush();
      return redirect('/admin')->with('flash_success_msg','logout successfull');
    }
    // End -- logout function

    public function settings(){
        return view('admin.settings');
    }

    
// Starts -- current password validation
    public function checkPwd(Request $request){
      $data = $request->all();
      $current_password=$data['current_pwd'];
      $check_password = User::where(['admin'=>'1'])->first();
      if(Hash::check($current_password,$check_password->password)){
        echo "true"; die;
        }
        else{
          echo "false"; die;
        }
    }
    // Ends -- current password validation

    // Starts -- Update password
    public function updatepassword(Request $request){
      if($request->ismethod('post')){

      $data = $request->all();
      $check_password = User::where(['email'=>Auth::User()->email])->first();
      $current_password=$data['current_pwd'];
      if(Hash::check($current_password,$check_password->password)){
       
        $password = bcrypt($data['new_pwd']);
        User::where('id','1')->update(['password'=>$password]);
         return redirect('/admin/settings')->with('flash_success_msg','update successfull');
        }
        else{
        
            return redirect('/admin/settings')->with('flash_err_msg','Incorrect current password.Fail to update password!');
        }
      }
    }
    // Ends -- Update password
    
}
