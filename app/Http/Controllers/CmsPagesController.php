<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CmsPage;
use App\Category;
use Illuminate\Support\Facades\Mail;
use Validator; //validatorclass

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
    
    // contact page
     public function contact(Request $request){
     	if($request->ismethod('post')){
    		$data=$request->all();

    		//Laravel manual validation rules
    		$validator =Validator::make($request->all(),[
		        'name'=>'required|regex:/^[\pL\s\-]+$/u|max:255',// alpha numeric
		        'email'=>'required|email',
		        'comment'=>'required',
		        'subject'=>'required'
		      ]);
    		//validation error handler
    		// include ds line at the header ---use Validator; //validatorclass
    		if($validator->fails()){
    			return redirect()->back()->withErrors($validator)->withInput();
    		}
          
    		//Start...Send confirmation email
                $email ="admin_ecom@yopmail.com";
                $messageData =[
                	'email'=>$data['email'],
                	'name'=>$data['name'],
                	'subject'=>$data['subject'],
                	'comment'=>$data['comment']
                ];
                Mail::send('emails.enquiry',$messageData,function($message)use($email){
                    $message->to($email)->subject('Enquiry from e-com website');
                });
                return redirect()->back()->with('flash_success_msg','Message Sent. Thanks for contacting us. We will get back to you soon!');

                //End...Send confirmation email

    	}
     	 // get all categories and subcategories along with the 'categories' relationship
    	$categories = Category::with('categories')->where(['parent_id'=>0])->get();
     	return view('pages.contact')->with(compact('categories'));

     }

}
