<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    //
	// FUNCTION TO INSERT CATEGORY TO categories TABLE IN DB
    public function addCategory(Request $request){
    	if($request->ismethod('post')){
    		$data=$request->all();
    		//echo "<pre>"; print_r($data); die;

            // Laravel validation for meta tags fields
            $this->validate($request,[
                'meta_title'=>'required',
                'meta_description'=>'required',
                'meta_keywords'=>'required'
            ]);
            if(empty($data['status'])){
                $status=0;
            }else{
                $status=1;
            }

        	$category =new Category;
        	$category->name = $data['category_name'];
            $category->parent_id = $data['parent_id']; 
        	$category->description = $data['description'];
        	$category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords']; 
            $category->status = $status;
        	$category->save();
        	 return redirect('/admin/view-category')->with('flash_success_msg','New category Added successfully!');       	
    	}
    	$levels = Category::where(['parent_id'=>0])->get();
    	return view('admin.categories.add_category')->with(compact('levels'));
    }

    // FUNCTION TO RETRIEVE AND DISPLAY DATA FROM DB ON VIEW-CATEGORY BLADE FILE
    public function viewCategories(){
        $categories = Category::get();
        return view('admin.categories.view_categories')->with(compact('categories'));
    }

    // EDIT/ UPDATE CATEGORY FUNCTION
     public function  editCategory(Request $request, $id=null){
        // start of update category
        if($request->ismethod('post')){
            $data=$request->all();
            //echo "<pre>"; print_r($data); die;

            // Laravel validation for meta tags fields
            $this->validate($request,[
                'meta_title'=>'required',
                'meta_description'=>'required',
                'meta_keywords'=>'required'
            ]);

             if(empty($data['status'])){
                $status=0;
            }else{
                $status=1;
            }

            Category::where(['id'=>$id])->update(['name'=>$data['category_name'],'description'=>$data['description'],'url'=>$data['url'],'meta_title'=>$data['meta_title'],'meta_description'=>$data['meta_description'],'meta_keywords'=>$data['meta_keywords'],'status'=>$status]);

            return redirect('/admin/view-category')->with('flash_success_msg','Category Updated successfully!');
        }
        // end of update category

        //retrieve and display data for editing from db on edit-category blade file
             $categoryDetails = Category::where(['id'=>$id])->first();
             $levels = Category::where(['parent_id'=>0])->get(); // for adding subcategories to display list
            return view('admin.categories.edit_category')->with(compact('categoryDetails','levels'));
        }

        //FUNCTION TO DELETE CATEGORY
        public function deleteCategory(Request $request, $id=null){
            if(!empty($id)){
                Category::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_success_msg','Category Deleted successfully!');
            }

        }
       
       
}
 