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
            $banner->msg = $data['msg'];
            
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

    public function  viewBanners(){
        $banners = Banner::get();
        return view('admin.banners.view_banner')->with(compact('banners'));
    }
    
    public function  editBanner(Request $request, $id=null){
    	

        // start of update banner table       
        if($request->ismethod('post')){
            $data=$request->all();
            //status check
            if(empty($data['status'])){
                $status=0;
            }else{
                $status=1;
            }  

            // titile
            if(empty($data['title'])){
            	$title='';
            }
            // msg
            if(empty($data['msg'])){
                $msg='';
            }
            // link
            if(empty($data['link'])){
                $link='';
            }
            //start--- image upload;
            if($request->hasFile('image')){
        		$image_tmp = Input::file('image');
        		if($image_tmp->isValid()){
        			$extension = $image_tmp->getClientOriginalExtension();
        			$filename =rand(111,99999).'.'.$extension;
        			$banner_image_path = 'images/frontend_images/images/banners/'.$filename;

        			//RESIZE IMAGE
        			Image::make($image_tmp)->resize(1140,441)->save($banner_image_path);
        		}
        	
        	}else if(!empty($data['current_image'])){
        		$filename = $data['current_image'];
        	}else{
        		$filename='';
        	}        	
        	// End ---- Image upload 


        	// Update data
        	Banner::where(['id'=>$id])->update(['title'=>$data['title'],'msg'=>$data['msg'],'link'=>$data['link'],'image'=>$filename,'status'=>$status]);
        	return redirect('/admin/view-banner')->with('flash_success_msg','Slider Updated successfully!');
        }
        // end of update banner table 
        // retrieve data for editing
        $bannerDetails = Banner::where('id',$id)->first();
        return view('admin.banners.edit_banner')->with(compact('bannerDetails'));      
    }

     //FUNCTION TO DELETE BANNER IMAGE
    public function deleteBannerImage($id=null){
        //get banner/slider image name
        $bannerImage =Banner::where(['id'=>$id])->first();
           
        //get banner/slider image paths
       $banner_image_path = 'images/frontend_images/images/banners/';

        //delete banner image if exist in folder
        if(file_exists($banner_image_path.$bannerImage->image)){
            unlink($banner_image_path.$bannerImage->image);
        }
       
        // delete image from banner table
        Banner::where(['id'=>$id])->update(['image'=>'']);
            return redirect()->back()->with('flash_success_msg','Slider Image Deleted successfully!');
    } 
    public function deleteBanner($id=null){
        Banner::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_success_msg','Slider Deleted successfully!');
    }

}
