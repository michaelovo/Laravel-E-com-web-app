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
        	 return redirect('/admin/add-category')->with('flash_categoryadd_success_msg','New category Added successfully!');       	
    	}
    	
    	return view('admin.categories.add_category');
    }
}
 