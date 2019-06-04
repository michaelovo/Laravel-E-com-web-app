<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use Auth;
use Session;
use App\Product;
use App\Category;
use App\ProductsAttribute;

class ProductsController extends Controller
{
    
    // FUNCTION TO INSERT PRODUCT TO products TABLE IN DB
    public function addProduct(Request $request){
    	// Start -- Insert into 'products' table in db
    	if($request->ismethod('post')){
    		$data=$request->all();
    		//echo "<pre>"; print_r($data); die;

    		//Start --This compare users to either select main/subcategory field when adding product
            if(empty($data['category_id'])){
            	 return redirect()->back()->with('flash_err_msg','Please select one of either Main or Subcategory!. Thank you!');
            }        		
             //End --This compare users to either select main/subcategory field when adding product

        	$product = new Product;
        	$product->product_name = $data['product_name'];
            $product->category_id = $data['category_id']; // to insrt subcatgory into db
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            
            //Start --If description field is empty or not, submit data
            /*
            * use this if this field is not validated @edit_product function in matrix.form_validation.js
	            if(!empty($data['description'])){
	            	 $product->description = $data['description'];
	            }else{
	            	 $product->description ='';
	            }
            */
             //End --If description field is empty or not, submit data
            $product->description =$data['product_color'];
        	$product->price = $data['price'];
        	
        	// Start ---- Image upload        	
        	if($request->hasFile('image')){
        		//echo $image_tmp = Input::file('image');die;
        		$image_tmp = Input::file('image');
        		if($image_tmp->isValid()){
        			$extension = $image_tmp->getClientOriginalExtension();
        			$filename =rand(111,99999).'.'.$extension;
        			$large_image_path = 'images/backend_images/products/large/'.$filename;
        			$medium_image_path = 'images/backend_images/products/medium/'.$filename;
        			$small_image_path = 'images/backend_images/products/small/'.$filename;

        			//RESIZE IMAGE
        			Image::make($image_tmp)->save($large_image_path);
        			Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
        			Image::make($image_tmp)->resize(300,300)->save($small_image_path);

        			//STORE IMAGE NAME IN 'products' TABLE
        			$product->image = $filename;

        		}
        	}
        	// End ---- Image upload
        	$product->save();
        	// return redirect()->back()->with('flash_success_msg','New product Added successfully!');
        	  return redirect('/admin/view-product')->with('flash_success_msg','New Product Added successfully!');        	  	
    	}
    	// End -- Insert into products table in db
	

    	// start -- Retrieve and display main categories and subcategories from 'categories' table
    	 $categories = Category::where(['parent_id'=>0])->get();
    	 $categories_dropdown ="<option value='' selected disabled>selected</option>";
	    	foreach ($categories as $cat) {
		    	 $categories_dropdown .="<option value='".$cat->id."'>".$cat->name."</option>";
			    	 $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
			    	 foreach ($sub_categories as $sub_cat) {
			    	 	$categories_dropdown .="<option value='".$sub_cat->id."'>&nbsp;--&nbsp".$sub_cat->name."</option>";

			    	 }
		
	    	}
    	 // End -- Retrieve and display main categories and subcategories from 'categories' table
    	 return view('admin.products.add_product')->with(compact('categories_dropdown'));	
    }
    

    // FUNCTION TO RETRIEVE AND DISPLAY DATA FROM 'products' table in DB ON VIEW-PRODUCTS BLADE FILE
    public function viewproducts(){
        $products = Product::get();
        //To retrieve and display category name from 'categories' table on view_products blade files
        foreach ($products as $key => $value) {
        	$category_name = Category::where(['id'=>$value->category_id])->first();
        	$products[$key]->category_name = $category_name->name;
        	
        }
        return view('admin.products.view_products')->with(compact('products'));
    }


     // EDIT/ UPDATE PRODUCTS FUNCTION
    public function  editProduct(Request $request, $id=null){
        // start of update Product        
        if($request->ismethod('post')){
            $data=$request->all();
            //echo "<pre>"; print_r($data); die;

            // Start ---- Image upload
        	/*
        		If we upload new image from edit product form then 'if' part will work and
        		new image will get uploaded, otherwise we will pick current_image name name
        		again from form. In both cases we will update varaiable '$filename' that can
        		have current or new image name

        	*/
        	if($request->hasFile('image')){
        		//echo $image_tmp = Input::file('image');die;
        		$image_tmp = Input::file('image');
        		if($image_tmp->isValid()){
        			$extension = $image_tmp->getClientOriginalExtension();
        			$filename =rand(111,99999).'.'.$extension;
        			$large_image_path = 'images/backend_images/products/large/'.$filename;
        			$medium_image_path = 'images/backend_images/products/medium/'.$filename;
        			$small_image_path = 'images/backend_images/products/small/'.$filename;

        			//RESIZE IMAGE
        			Image::make($image_tmp)->save($large_image_path);
        			Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
        			Image::make($image_tmp)->resize(300,300)->save($small_image_path);        			
        		}
        	}else{
        		$filename = $data['current_image'];
        	}        	
        	// End ---- Image upload       	

            Product::where(['id'=>$id])->update(['category_id'=>$data['category_id'],'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'description'=>$data['description'],'price'=>$data['price'],'image'=>$filename]);

            //return redirect()->back()->with('flash_success_msg','Product Updated successfully!');
             return redirect('/admin/view-product')->with('flash_success_msg','Product Updated successfully!');
        }
        // end of update Product
		
        //retrieve and display data for editing from db on edit-category blade file
             $productDetails = Product::where(['id'=>$id])->first(); //get product details
            
    	// start -- Retrieve and display main categories and subcategories from 'categories' table
    	 $categories = Category::where(['parent_id'=>0])->get();
    	 $categories_dropdown ="<option value='' selected disabled>selected</option>";
    	foreach ($categories as $cat) {
    	 	// Start ...Compare and auto-select category for product
    	 	if($cat->id==$productDetails->category_id){
    	 		$selected ="selected";
    	 	}else{
    	 		$selected ="";
    	 	}
    	 // End ...Compare and auto-select category for product
    	 $categories_dropdown .="<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
	    	 $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
	    	 foreach ($sub_categories as $sub_cat) {
	    	 	// Start ...Compare and auto-select subcategory for product
	    	 	if($sub_cat->id==$productDetails->category_id){
    	 			$selected ="selected";
	    	 	}else{
	    	 		$selected ="";
	    	 	}
	    	 	// End ...Compare and auto-select category for product
	    	 	$categories_dropdown .="<option value='".$sub_cat->id."'>&nbsp;--&nbsp".$sub_cat->name."</option>";

	    	 }
    	 	
    	}
    	 // End -- Retrieve and display main categories and subcategories from 'categories' table
            return view('admin.products.edit_product')->with(compact('productDetails','categories_dropdown'));//,'levels'));
    }

        
        //FUNCTION TO DELETE PRODUCT
    public function deleteProduct($id=null){
            //if(!empty($id)){
                Product::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_success_msg','Product Deleted successfully!');
            //}

    }

        //FUNCTION TO DELETE PRODUCT IMAGE
    public function deleteProductImage($id=null){
        Product::where(['id'=>$id])->update(['image'=>'']);
            return redirect()->back()->with('flash_success_msg','Product Image Deleted successfully!');
    }

    	 //START FUNCTION TO ADD PRODUCT ATTRIBUTES
 	public function  addAttributes(Request $request, $id=null){
 		$productDetails = Product::with('attributes')->where(['id'=>$id])->first();
 		//$productDetails = json_decode(json_encode($productDetails));
 		//echo "<pre>"; print_r($productDetails); die;
 		if($request->ismethod('post')){
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
    		foreach ($data['sku'] as $key => $val) {
    			if(!empty($val)){
    				$attribute = new ProductsAttribute;
    				$attribute->product_id =$id;
    				$attribute->sku =$val;
    				$attribute->size = $data['size'][$key];
    				$attribute->price = $data['price'][$key];
    				$attribute->stock = $data['stock'][$key];
    				$attribute->save();
    			}
    			
    		}
    		 return redirect('/admin/add-attributes/'.$id)->with('flash_success_msg','Product Atrributes Added successfully!');
    	}
           
 		return view('admin.products.add_attributes')->with(compact('productDetails'));
    }
    	 //END FUNCTION TO ADD PRODUCT ATTRIBUTES


           //START--FUNCTION TO DELETE PRODUCT ATTRIBUTES
    public function deleteAttributes($id=null){
        if(!empty($id)){
            ProductsAttribute::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_success_msg','Product Attribute Deleted successfully!');
        }
           
    }
         //END--FUNCTION TO DELETE PRODUCT ATTRIBUTES


           //START--CATEGORY LISTING FUNCTION
    public function products($url=null){
        // show 404 page if category url does not exist
        $countCategory = Category::where(['url'=>$url])->count();
        //echo $countCategory; die;
        if($countCategory==0){
            abort(404);
        }
        // get all categories and subcategories along with the 'categories' relationship
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $categoriesDetails = Category::where(['url'=>$url])->first(); //get all categories  by url

        //start --- check category/subcategory url
        if($categoriesDetails->parent_id==0){
            //if url is main category url
            $subcategories = Category::where(['parent_id'=>$categoriesDetails->id])->get();
            //$cat_id="";
            foreach ($subcategories as $subcat) {
                $cat_id[]=$subcat->id;
                # code...
            }
            //print_r($cat_id); die;
        $productsAll = Product::whereIn('category_id',$cat_id)->get();
        //$productsAll = json_decode(json_encode($productsAll));
        //echo "<pre>"; print_r($productsAll); die;

        }else{
             //if url is sub category url
            $productsAll = Product::where(['category_id'=>$categoriesDetails->id])->get();

        }
         //end --- check category/subcategory url
        return view('products.listing')->with(compact('categoriesDetails','productsAll','categories'));         
    }
         //END--CATEGORY LISTING FUNCTION
}
