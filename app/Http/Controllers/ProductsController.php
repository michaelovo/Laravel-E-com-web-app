<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Product;
use App\Category;

class ProductsController extends Controller
{
    //
    // FUNCTION TO INSERT PRODUCT TO products TABLE IN DB
    public function addProduct(Request $request){

    	// to retrieve and display main categories and subcategories
    	 $categories = Category::where(['parent_id'=>0])->get();
    	 $categories_dropdown ="<option selected disabled>selected</option>";
    	 foreach ($categories as $cat) {
    	 $categories_dropdown .="<option value='".$cat->id."'>".$cat->name."</option>";
	    	 $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
	    	 foreach ($sub_categories as $sub_cat) {
	    	 	$categories_dropdown .="<option value='".$sub_cat->id."'>&nbsp;--&nbsp".$sub_cat->name."</option>";

	    	 }
    	 	
    	 }
    	 return view('admin.products.add_product')->with(compact('categories_dropdown'));
    	/*
    	if($request->ismethod('post')){
    		$data=$request->all();
    		//echo "<pre>"; print_r($data); die;

        	$product =new Product;
        	$product->name = $data['product_name'];
            $product->category_id = $data['category_id']; // to insrt subcatgory into db
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
        	$product->description = $data['description'];
        	$product->price = $data['price'];
        	$product->image = $data['image'];
        	$product->save();
        	 return redirect('/admin/add-product')->with('flash_categoryadd_success_msg','New category Added successfully!');       	
    	}
    	//$levels = Category::where(['parent_id'=>0])->get();
    	return view('admin.products.add_product');//->with(compact('levels'));
    	*/
    }
    
}
