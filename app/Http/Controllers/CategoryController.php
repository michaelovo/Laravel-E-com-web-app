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

        	$category =new Category;
        	$category->name = $data['category_name'];
        	$category->description = $data['description'];
        	$category->url = $data['url'];
        	$category->save();
        	 return redirect('/admin/view-category')->with('flash_categoryadd_success_msg','New category Added successfully!');       	
    	}
    	
    	return view('admin.categories.add_category');
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
            Category::where(['id'=>$id])->update(['name'=>$data['category_name'],'description'=>$data['description'],'url'=>$data['url']]);

            return redirect('/admin/view-category')->with('flash_categoryadd_success_msg','Category Updated successfully!');
        }
        // end of update category

        //retrieve and display data for editing from db on edit-category blade file
             $categoryDetails = Category::where(['id'=>$id])->first();
            return view('admin.categories.edit_category')->with(compact('categoryDetails'));
        }
       
}
 