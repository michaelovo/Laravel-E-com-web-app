<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CmsPage;
use App\Category;

class CmsPagesController extends Controller
{
    // Add CMS Page
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
        	
        	return redirect('/admin/view-cms-pages')->with('flash_success_msg','New CMS page Added successfully!'); 
    	}
    	return view('admin.pages.add_cms_page');//->with(compact('products'));
    }

    // View CMS Pages
    public function viewCmsPages(){
        $cmsPages = CmsPage::orderby('id','asc')->get(); //get all pages from db
        return view('admin.pages.view_cms_pages')->with(compact('cmsPages'));
    }

    // Edit CMS page
    public function editCmsPage(Request $request, $id=null){
        // start update cms page content       
        if($request->ismethod('post')){
            $data=$request->all();

            //status check
            if(empty($data['status'])){
                $status=0;
            }else{
                $status=1;
            }

            //update cms_pages table
            CmsPage::where(['id'=>$id])->update(['title'=>$data['title'],'url'=>$data['url'],'description'=>$data['description'],'status'=>$status]);

            return redirect('/admin/view-cms-pages')->with('flash_success_msg','CMS page Updated successfully!');
        }
        // update cms page content    
	
             $cmsPages = CmsPage::where(['id'=>$id])->first(); //rettrieve/get page details for editing 
            return view('admin.pages.edit_cms_page')->with(compact('cmsPages'));
    }

    //Delete CMS Page
    public function deleteCmsPage($id=null){
        CmsPage::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_success_msg','CMS page Deleted successfully!');
            //}

    }

    // CMS pages
    public function  CmsPages($url){
    	 // show 404 page if page status is Inactive
        $cmsPageCount = CmsPage::where(['url'=>$url,'status'=>1])->count();
        //echo $countCategory; die;
        if($cmsPageCount==0){
            abort(404);
        }
        $cmsPageDetails = CmsPage::where('url',$url)->first(); //get all pages from db

        // get all categories and subcategories along with the 'categories' relationship
    	$categories = Category::with('categories')->where(['parent_id'=>0])->get();
        
        return view('pages.cms_pages')->with(compact('cmsPageDetails','categories'));
    }
    
}
