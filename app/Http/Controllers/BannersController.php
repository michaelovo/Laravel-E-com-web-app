<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Banner;
use Image;
use Auth;
use Session;

class BannersController extends Controller
{
    //
     public function addBanner(Request $request){
     	// Start -- Insert into 'products' table in db
    	if($request->ismethod('post')){
    		$data=$request->all();

        	$banner = new Banner;
        	$banner->title = $data['title'];
            $banner->link = $data['link']; 
            
            //status check
             if(empty($data['status'])){
                $status=0;
            }else{
                $status=1;
            }           
        	// Start ---- Image upload        	
        	if($request->hasFile('image')){
        		$image_tmp = Input::file('image');
        		if($image_tmp->isValid()){
        			$extension = $image_tmp->getClientOriginalExtension();
        			$filename =rand(111,99999).'.'.$extension;
        			$banner_image_path = 'images/frontend_images/images/banners/'.$filename;

        			//RESIZE IMAGE
        			Image::make($image_tmp)->resize(1140,441)->save($banner_image_path);

        			//STORE IMAGE NAME IN 'banners' TABLE
        			$banner->image = $filename;
        		}
        	}
        	// End ---- Image upload
        	$banner->status=$status;  
        	$banner->save();
        	return redirect('/admin/add-banner')->with('flash_success_msg','New Slider Added successfully!');
        }
    	// End -- Insert into banners table in db
     	return view('admin.banners.add_banner');
     }
}
