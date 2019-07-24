<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CmsPage;

class CmsPagesController extends Controller
{
    //
    public function addCmsPage(Request $request){
    	// Start -- Insert into 'cms_pages' table in db
    	if($request->ismethod('post')){
    		$data=$request->all();

    		$cmsPage = new CmsPage;
        	$cmsPage->title = $data['title'];
            $cmsPage->url = $data['url']; 
            $cmsPage->description = $data['description']; 

            //status check
             if(empty($data['status'])){
                $status=0;
            }else{
                $status=1;
            }
            $cmsPage->status = $status; 
            $cmsPage->save(); //send to db
        	
        	return redirect()->back()->with('flash_success_msg','New CMS page Added successfully!');
        	 //return redirect('/admin/view-cms-pages')->with('flash_success_msg','New CMS page Added successfully!'); 
    	}
    	return view('admin.pages.add_cms_page');//->with(compact('products'));
    }
}
