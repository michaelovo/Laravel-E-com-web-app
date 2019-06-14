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
use App\ProductsImage;
use App\Coupon;
use DB;


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
            //$product->care = $data['care'];
            
            //Start --If care field is empty or not, submit data
            
            // use this if this field is not validated @edit_product function in matrix.form_validation.js
	            if(!empty($data['care'])){
	            	 $product->care = $data['care'];
	            }else{
	            	 $product->care ='';
	            }
            
             //End --If care field is empty or not, submit data
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
            //status check
             if(empty($data['status'])){
                $status=0;
            }else{
                $status=1;
            }
            $product->status=$status;
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
        $products = Product::orderby('id','asc')->get();
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
            //Start --This compare users to either select main/subcategory field when adding product
            if(empty($data['category_id'])){
                 return redirect()->back()->with('flash_err_msg','Please select one of either Main or Subcategory!. Thank you!');
            }               
             //End --This compare users to either select main/subcategory field when adding product

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
            if(empty($data['care'])){
                $data['care'] ='';
            }    
            //status check
             if(empty($data['status'])){
                $status=0;
            }else{
                $status=1;
            }
	

            Product::where(['id'=>$id])->update(['category_id'=>$data['category_id'],'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'description'=>$data['description'],'care'=>$data['care'],'price'=>$data['price'],'image'=>$filename,'status'=>$status]);

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
        //get product image name
        $productImage =Product::where(['id'=>$id])->first();
            //echo $productImage->image; die;
        //get product image paths
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        //delete large image if not exist in folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }
        //delete medium image if not exist in folder
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }
        //delete small image if not exist in folder
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }
        // delete image from product table
        Product::where(['id'=>$id])->update(['image'=>'']);
            return redirect()->back()->with('flash_success_msg','Product Image Deleted successfully!');
    }

    //START ----FUNCTION TO DELETE PRODUCT ALTERNATE IMAGE
    public function deleteAltImage($id=null){
        //get product image name
        $productImage =ProductsImage::where(['id'=>$id])->first();
            //echo $productImage->image; die;
        //get product image paths
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        //delete large image if not exist in folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }
        //delete medium image if not exist in folder
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }
        //delete small image if not exist in folder
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }
        // delete image from product table
        ProductsImage::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_success_msg','Product Alternate Image Deleted successfully!');
    }
    //END ----FUNCTION TO DELETE PRODUCT ALTERNATE IMAGE

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
                    //SKU check to prevent duplicate
                    $attrCountSKU = ProductsAttribute::where('sku',$val)->count();
                    if($attrCountSKU >0){
                        return redirect('/admin/add-attributes/'.$id)->with('flash_err_msg','SKU already exist! Please try another SKU');
                    }
                    //Size check to prevent duplicate
                    $attrCountSize = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrCountSize >0){
                        return redirect('/admin/add-attributes/'.$id)->with('flash_err_msg','"'.$data['size'][$key].' " Size already exist for this product! Please try another Size');
                    }
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

         //START FUNCTION TO EDIT/UPDATE PRODUCT ATTRIBUTES
    public function  editAttributes(Request $request, $id=null){      
        if($request->ismethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            foreach ($data['idAttr'] as $key => $attr) {
                ProductsAttribute::where(['id'=>$data['idAttr'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
            }
            return redirect()->back()->with('flash_success_msg','Product Attribute Updated successfully!');
            
        }
  
    }
        //END FUNCTION TO EDIT/UPDATE PRODUCT ATTRIBUTES


         //START FUNCTION TO ADD PRODUCT ALTERNATE IMAGES
    public function  addImages(Request $request, $id=null){
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
       
        if($request->ismethod('post')){
            // add alternate image
            $data = $request->all();
            
            if($request->hasFile('image')){
                $files = $request->file('image');
                foreach ($files as $file) {

                   //Upload image after resize
                    $image = new ProductsImage;
                    $extension = $file->getClientOriginalExtension();
                    $filename =rand(111,99999).'.'.$extension; //generate name randomly
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;

                    //RESIZE IMAGE
                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(600,600)->save($medium_image_path);
                    Image::make($file)->resize(300,300)->save($small_image_path);

                    //STORE IMAGE NAME IN 'product_images' TABLE
                    $image->image = $filename;
                    $image->product_id = $data['product_id'];
                    $image->save();
                }
                 return redirect('/admin/add-images/'.$id)->with('flash_success_msg','Product Alternate image(s) Added successfully!');
            }
        }
        // get all images of product from db
        $productsImages = ProductsImage::where(['product_id'=>$id])->get();
        return view('admin.products.add_images')->with(compact('productDetails','productsImages'));
    }
         //END FUNCTION TO ADD PRODUCT ALTERNATE IMAGES


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
        // show 404 page if category url does not exist or category status is disabled
        $countCategory = Category::where(['url'=>$url,'status'=>1])->count();
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
            // get and display only product whose status value=1
        $productsAll = Product::whereIn('category_id',$cat_id)->where('status',1)->get();
        //$productsAll = json_decode(json_encode($productsAll));
        //echo "<pre>"; print_r($productsAll); die;

        }else{
             //if url is sub category url  and status value=1
            $productsAll = Product::where(['category_id'=>$categoriesDetails->id])->where('status',1)->get();

        }
         //end --- check category/subcategory url
        return view('products.listing')->with(compact('categoriesDetails','productsAll','categories'));         
    }
         //END--CATEGORY LISTING FUNCTION

     // GET PRODUCT DETAILS
    public function product($id=null){
        // show 404 page if product is disabled
        $productsCount = Product::where(['id'=>$id,'status'=>1])->count();
        if($productsCount==0){
            abort(404);
        }
       //get product details
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
        // $productDetails = json_decode(json_encode( $productDetails));
        //echo "<pre>"; print_r( $productDetails); die;

        /*get related/Recommended products to be display on product 'detail' page
        NB: No repetition and as such the main product will not display under Recommended items.
        */
        $relatedProducts = Product::where('id','!=',$id)->where(['category_id'=>$productDetails->category_id])->get();
        // using array 'chunk()' to load a specific(3) number of item at a time
        /*
        foreach($relatedProducts->chunk(3)as $chunk){
            foreach($chunk as $item){
                echo $item; echo "<br>";
                # code...
            }
            # code...
            echo "<br><br><br>";
        }die;
        */
        // get all categories and subcategories along with the 'categories' relationship
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        //get product alternate images
        $productsAltImages = ProductsImage::where('product_id',$id)->get();

        //get total stock of the product
        $total_stock = ProductsAttribute::where('product_id',$id)->sum('stock');
       return view('products.detail')->with(compact('productDetails','categories','productsAltImages','total_stock','relatedProducts'));
    }

    // get product prices according to selected size
    public function getProductPrice(Request $request){
        $data = $request->all();
        //echo "<pre>"; print_r($data);die;
        $proArr = explode("-",$data['idSize']);
       //echo $proArr[0]; echo $proArr[1];die;
        $proAttr = ProductsAttribute::where(['product_id' => $proArr[0],'size' => $proArr[1]])->first();
        echo $proAttr->price;
        
        //get attribute stock
        echo "#";
        echo $proAttr->stock;

    }

    //ADD TO CART FUNCTION
    public function addtocart(Request $request){
        $data = $request->all();
       //If no size is selected before adding to cart then display error message
        if(empty($data['size'])){
            return redirect()->back()->with('flash_err_msg','Please select a size! Thank you!');
        } 
        // if user mail is empty
        if(empty($data['user_email'])){
            $data['user_email'] ='';
        }

        // if session_id does not exist, then creat one else use the existing session_id
        $session_id = Session::get('session_id');
        if(empty($session_id)){
           $session_id = str_random(40);//die; //generate random strings
           Session::put('session_id',$session_id); // session variable
            
        }
         $sizeArr = explode("-",$data['size']); //send only the size name to cart table not (id-size, e.g 4-medium)

         // to prevent duplicate of cart products in thesame session i.e having thesame seesion_id
         $countProducts =DB::table('cart')->where(['product_id'=>$data['product_id'],'product_color'=>$data['product_color'],'size'=>$sizeArr[1],'session_id'=>$session_id])->count();//die;
         
            //if product does not exist for that session then add product else redirect
        if($countProducts >0){
            return redirect()->back()->with('flash_err_msg','Product Already Exists in Cart!');
        }else{
            //get and add product sku to cart table instead of product code
            $getSKU = ProductsAttribute::select('sku')->where(['product_id'=>$data['product_id'],'size'=>$sizeArr[1]])->first();

            // Insert into cart table
            DB::table('cart')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_code'=>$getSKU->sku,'product_color'=>$data['product_color'],'price'=>$data['price'],'size'=>$sizeArr[1],'quantity'=>$data['quantity'],'user_email'=>$data['user_email'],'session_id'=>$session_id]);//die;

        }
        return redirect('cart')->with('flash_success_msg','Product Added in Cart Successfully!.');
    }
    // DISPLAY CART ITEMS AND IMAGES FROM CART TABLE ON CART BLADE FILE
    public function cart(){
        $session_id = Session::get('session_id');
        $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();

        // get and display each cart item product image
        foreach ($userCart as $key => $product) {
            //echo $product->product_id;
            $productDetails = Product::where('id',$product->product_id)->first();
            $userCart[$key]->image= $productDetails->image;
        }
        //echo "<pre>"; print_r($userCart);die;

        return view('products.cart')->with(compact('userCart'));
    }
        //UPDATE CART QUANTITY FUNCTION
    public function updateCartQuantity($id=null, $quantity=null){
        
        $getCartDetails = DB::table('cart')->where('id',$id)->first();//get cart details fron cart table
        $getAttributeStock = ProductsAttribute::where('sku',$getCartDetails->product_code)->first(); //get attribute stock from productAttribute table
        
        $updated_quantity = $getCartDetails->quantity + $quantity;  // get user demanded quantity

        // if total sku is greater than or equal to the quantity demanded by user
        if($getAttributeStock->stock >= $updated_quantity){
            DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
            return redirect('cart')->with('flash_success_msg','Product Quantity has been Update Successfully!');
        }else{
            return redirect()->back()->with('flash_err_msg','Required product Quantity is not Available!'); 
        }


    }
        //DELETE PRODUCT(S) FROM CART FUNCTION
    public function deleteCartProduct($id=null){
        //echo $id;die;
        DB::table('cart')->where('id',$id)->delete();
        return redirect('cart')->with('flash_success_msg','Product has been Deleted from Cart Successfully!');

    }

    //APPLY COUPON
    public function applyCoupon(Request $request){
        $data = $request->all();
        $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count(); //count available coupons
        // check user entered coupon codes from cart blade to that of coupons table
        if($couponCount == 0){
            return redirect()->back()->with('flash_err_msg','Invalid Coupon!');
        }else{
            // perform othe checks like active/inactive, expiry date, etc
            echo "success";die;
        }

    }
}
