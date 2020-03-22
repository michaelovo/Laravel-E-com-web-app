<?php

namespace App\Http\Controllers;

use App\Category;
use App\CodZipcode;
use App\Country;
use App\Coupon;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use App\PrepaidZipcode;
use App\Product;
use App\ProductsAttribute;
use App\ProductsImage;
use App\User;
use App\Zipcode;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Image;
use Session;

class ProductsController extends Controller
{

    // FUNCTION TO INSERT PRODUCT TO products TABLE IN DB
    public function addProduct(Request $request)
    {
        // Start -- Insert into 'products' table in db
        if ($request->ismethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            //Start --This compare users to either select main/subcategory field when adding product
            if (empty($data['category_id'])) {
                return redirect()->back()->with('flash_err_msg', 'Please select one of either Main or Subcategory!. Thank you!');
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
            if (!empty($data['care'])) {
                $product->care = $data['care'];
            } else {
                $product->care = '';
            }

            if (!empty($data['sleeve'])) {
                $product->sleeve = $data['sleeve'];
            } else {
                $product->sleeve = '';
            }

            if (!empty($data['pattern'])) {
                $product->pattern = $data['pattern'];
            } else {
                $product->pattern = '';
            }

            //End --If care field is empty or not, submit data
            $product->description = $data['product_color'];
            $product->price = $data['price'];

            // Start ---- Image upload
            if ($request->hasFile('image')) {
                //echo $image_tmp = Input::file('image');die;
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/backend_images/products/large/' . $filename;
                    $medium_image_path = 'images/backend_images/products/medium/' . $filename;
                    $small_image_path = 'images/backend_images/products/small/' . $filename;

                    //RESIZE IMAGE
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                    //STORE IMAGE NAME IN 'products' TABLE
                    $product->image = $filename;

                }
            }
            // End ---- Image upload

            // Start ---- Video upload
            if ($request->hasFile('video')) {
                $video_tmp = Input::file('video');
                $video_name = $video_tmp->getClientOriginalName();
                $video_path = 'videos/';
                $video_tmp->move($video_path, $video_name);
                $product->video = $video_name;
            }
            //End video upload
            //status check
            if (empty($data['status'])) {
                $status = 0;
            } else {
                $status = 1;
            }
            //Feature items check
            if (empty($data['feature_item'])) {
                $feature_item = 0;
            } else {
                $feature_item = 1;
            }

            $product->status = $status;
            $product->feature_item = $feature_item;
            $product->save();
            // return redirect()->back()->with('flash_success_msg','New product Added successfully!');
            return redirect('/admin/view-product')->with('flash_success_msg', 'New Product Added successfully!');
        }
        // End -- Insert into products table in db

        // start -- Retrieve and display main categories and subcategories from 'categories' table
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option value='' selected disabled>selected</option>";
        foreach ($categories as $cat) {
            $categories_dropdown .= "<option value='" . $cat->id . "'>" . $cat->name . "</option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                $categories_dropdown .= "<option value='" . $sub_cat->id . "'>&nbsp;--&nbsp" . $sub_cat->name . "</option>";

            }

        }
        // End -- Retrieve and display main categories and subcategories from 'categories' table
        $sleeveArray = array("Long sleeve", "Short slevee", "Sleeveless");
        $patternArray = array("checked", "plain", "printed", "self", "solid");

        return view('admin.products.add_product')->with(compact('categories_dropdown', 'sleeveArray', 'patternArray'));
    }

    // FUNCTION TO RETRIEVE AND DISPLAY DATA FROM 'products' table in DB ON VIEW-PRODUCTS BLADE FILE
    public function viewproducts()
    {
        $products = Product::orderby('id', 'asc')->get();
        //To retrieve and display category name from 'categories' table on view_products blade files
        foreach ($products as $key => $value) {
            $category_name = Category::where(['id' => $value->category_id])->first();
            $products[$key]->category_name = $category_name->name;

        }
        return view('admin.products.view_products')->with(compact('products'));
    }

    // EDIT/ UPDATE PRODUCTS FUNCTION
    public function editProduct(Request $request, $id = null)
    {
        // start of update Product
        if ($request->ismethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            //Start --This compare users to either select main/subcategory field when adding product
            if (empty($data['category_id'])) {
                return redirect()->back()->with('flash_err_msg', 'Please select one of either Main or Subcategory!. Thank you!');
            }
            //End --This compare users to either select main/subcategory field when adding product

            // Start ---- Image upload
            /*
            If we upload new image from edit product form then 'if' part will work and
            new image will get uploaded, otherwise we will pick current_image name name
            again from form. In both cases we will update varaiable '$filename' that can
            have current or new image name

             */
            if ($request->hasFile('image')) {
                //echo $image_tmp = Input::file('image');die;
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/backend_images/products/large/' . $filename;
                    $medium_image_path = 'images/backend_images/products/medium/' . $filename;
                    $small_image_path = 'images/backend_images/products/small/' . $filename;

                    //RESIZE IMAGE
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path);
                }
            } else {
                $filename = $data['current_image'];
            }
            // End ---- Image upload

            if (empty($data['care'])) {
                $data['care'] = '';
            }
            //status check
            if (empty($data['status'])) {
                $status = 0;
            } else {
                $status = 1;
            }
            if (!empty($data['sleeve'])) {
                $sleeve = $data['sleeve'];
            } else {
                $sleeve = '';
            }

            if (!empty($data['sleeve'])) {
                $sleeve = $data['sleeve'];
            } else {
                $sleeve = '';
            }

            if (!empty($data['pattern'])) {
                $pattern = $data['pattern'];
            } else {
                $pattern = '';
            }

            // Start ---- Video upload
            if ($request->hasFile('video')) {
                $video_tmp = Input::file('video');
                $video_name = $video_tmp->getClientOriginalName();
                $video_path = 'videos/';
                $video_tmp->move($video_path, $video_name);
                $videoName = $video_name;
            } else if (!empty($data['current_video'])) {
                $videoName = $data['current_video'];
                // code...
            } else {
                $videoName = '';
            }
            //End video upload

            //Feature Items check
            if (empty($data['feature_item'])) {
                $feature_item = 0;
            } else {
                $feature_item = 1;
            }

            Product::where(['id' => $id])->update(['category_id' => $data['category_id'],
                'product_name' => $data['product_name'], 'product_code' => $data['product_code'],
                'product_color' => $data['product_color'], 'description' => $data['description'],
                'care' => $data['care'], 'price' => $data['price'], 'image' => $filename,
                'video' => $videoName, 'status' => $status, 'feature_item' => $feature_item, 'sleeve' => $sleeve, 'pattern' => $pattern]);

            //return redirect()->back()->with('flash_success_msg','Product Updated successfully!');
            return redirect('/admin/view-product')->with('flash_success_msg', 'Product Updated successfully!');
        }
        // end of update Product

        //retrieve and display data for editing from db on edit-category blade file
        $productDetails = Product::where(['id' => $id])->first(); //get product details

        // start -- Retrieve and display main categories and subcategories from 'categories' table
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option value='' selected disabled>selected</option>";
        foreach ($categories as $cat) {
            // Start ...Compare and auto-select category for product
            if ($cat->id == $productDetails->category_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            // End ...Compare and auto-select category for product
            $categories_dropdown .= "<option value='" . $cat->id . "' " . $selected . ">" . $cat->name . "</option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                // Start ...Compare and auto-select subcategory for product
                if ($sub_cat->id == $productDetails->category_id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                // End ...Compare and auto-select category for product
                $categories_dropdown .= "<option value='" . $sub_cat->id . "'>&nbsp;--&nbsp" . $sub_cat->name . "</option>";

            }

        }
        $sleeveArray = array("Long sleeve", "Short slevee", "Sleeveless");
        $patternArray = array("checked", "plain", "printed", "self", "solid");
        // End -- Retrieve and display main categories and subcategories from 'categories' table
        return view('admin.products.edit_product')->with(compact('productDetails', 'categories_dropdown', 'sleeveArray','patternArray')); //,'levels'));
    }

    //FUNCTION TO DELETE PRODUCT
    public function deleteProduct($id = null)
    {
        //if(!empty($id)){
        Product::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_success_msg', 'Product Deleted successfully!');
        //}

    }

    //FUNCTION TO DELETE PRODUCT IMAGE
    public function deleteProductImage($id = null)
    {
        //get product image name
        $productImage = Product::where(['id' => $id])->first();
        //echo $productImage->image; die;
        //get product image paths
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        //delete large image if not exist in folder
        if (file_exists($large_image_path . $productImage->image)) {
            unlink($large_image_path . $productImage->image);
        }
        //delete medium image if not exist in folder
        if (file_exists($medium_image_path . $productImage->image)) {
            unlink($medium_image_path . $productImage->image);
        }
        //delete small image if not exist in folder
        if (file_exists($small_image_path . $productImage->image)) {
            unlink($small_image_path . $productImage->image);
        }
        // delete image from product table
        Product::where(['id' => $id])->update(['image' => '']);
        return redirect()->back()->with('flash_success_msg', 'Product Image Deleted successfully!');
    }

    //FUNCTION TO DELETE PRODUCT VIDEO
    public function deleteProductVideo($id = null)
    {
        //get product video name
        $productVideo = Product::select('video')->where('id', $id)->first();
        $video_path = 'videos/'; //get product video paths

        //delete product video if exist in folder
        if (file_exists($video_path . $productVideo->video)) {
            unlink($video_path . $productVideo->video);
        }
        // delete video from product table
        Product::where(['id' => $id])->update(['video' => '']);
        return redirect()->back()->with('flash_success_msg', 'Product Video Deleted successfully!');
    }

    //START ----FUNCTION TO DELETE PRODUCT ALTERNATE IMAGE
    public function deleteAltImage($id = null)
    {
        //get product image name
        $productImage = ProductsImage::where(['id' => $id])->first();
        //echo $productImage->image; die;
        //get product image paths
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        //delete large image if not exist in folder
        if (file_exists($large_image_path . $productImage->image)) {
            unlink($large_image_path . $productImage->image);
        }
        //delete medium image if not exist in folder
        if (file_exists($medium_image_path . $productImage->image)) {
            unlink($medium_image_path . $productImage->image);
        }
        //delete small image if not exist in folder
        if (file_exists($small_image_path . $productImage->image)) {
            unlink($small_image_path . $productImage->image);
        }
        // delete image from product table
        ProductsImage::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_success_msg', 'Product Alternate Image Deleted successfully!');
    }
    //END ----FUNCTION TO DELETE PRODUCT ALTERNATE IMAGE

    //START FUNCTION TO ADD PRODUCT ATTRIBUTES
    public function addAttributes(Request $request, $id = null)
    {
        $productDetails = Product::with('attributes')->where(['id' => $id])->first();
        //$productDetails = json_decode(json_encode($productDetails));
        //echo "<pre>"; print_r($productDetails); die;
        if ($request->ismethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            foreach ($data['sku'] as $key => $val) {
                if (!empty($val)) {
                    //SKU check to prevent duplicate
                    $attrCountSKU = ProductsAttribute::where('sku', $val)->count();
                    if ($attrCountSKU > 0) {
                        return redirect('/admin/add-attributes/' . $id)->with('flash_err_msg', 'SKU already exist! Please try another SKU');
                    }
                    //Size check to prevent duplicate
                    $attrCountSize = ProductsAttribute::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                    if ($attrCountSize > 0) {
                        return redirect('/admin/add-attributes/' . $id)->with('flash_err_msg', '"' . $data['size'][$key] . ' " Size already exist for this product! Please try another Size');
                    }
                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }

            }
            return redirect('/admin/add-attributes/' . $id)->with('flash_success_msg', 'Product Atrributes Added successfully!');
        }

        return view('admin.products.add_attributes')->with(compact('productDetails'));
    }
    //END FUNCTION TO ADD PRODUCT ATTRIBUTES

    //START FUNCTION TO EDIT/UPDATE PRODUCT ATTRIBUTES
    public function editAttributes(Request $request, $id = null)
    {
        if ($request->ismethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            foreach ($data['idAttr'] as $key => $attr) {
                ProductsAttribute::where(['id' => $data['idAttr'][$key]])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
            }
            return redirect()->back()->with('flash_success_msg', 'Product Attribute Updated successfully!');

        }

    }
    //END FUNCTION TO EDIT/UPDATE PRODUCT ATTRIBUTES

    //START FUNCTION TO ADD PRODUCT ALTERNATE IMAGES
    public function addImages(Request $request, $id = null)
    {
        $productDetails = Product::with('attributes')->where(['id' => $id])->first();

        if ($request->ismethod('post')) {
            // add alternate image
            $data = $request->all();

            if ($request->hasFile('image')) {
                $files = $request->file('image');
                foreach ($files as $file) {

                    //Upload image after resize
                    $image = new ProductsImage;
                    $extension = $file->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension; //generate name randomly
                    $large_image_path = 'images/backend_images/products/large/' . $filename;
                    $medium_image_path = 'images/backend_images/products/medium/' . $filename;
                    $small_image_path = 'images/backend_images/products/small/' . $filename;

                    //RESIZE IMAGE
                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(600, 600)->save($medium_image_path);
                    Image::make($file)->resize(300, 300)->save($small_image_path);

                    //STORE IMAGE NAME IN 'product_images' TABLE
                    $image->image = $filename;
                    $image->product_id = $data['product_id'];
                    $image->save();
                }
                return redirect('/admin/add-images/' . $id)->with('flash_success_msg', 'Product Alternate image(s) Added successfully!');
            }
        }
        // get all images of product from db
        $productsImages = ProductsImage::where(['product_id' => $id])->get();
        return view('admin.products.add_images')->with(compact('productDetails', 'productsImages'));
    }
    //END FUNCTION TO ADD PRODUCT ALTERNATE IMAGES

    //START--FUNCTION TO DELETE PRODUCT ATTRIBUTES
    public function deleteAttributes($id = null)
    {
        if (!empty($id)) {
            ProductsAttribute::where(['id' => $id])->delete();
            return redirect()->back()->with('flash_success_msg', 'Product Attribute Deleted successfully!');
        }

    }
    //END--FUNCTION TO DELETE PRODUCT ATTRIBUTES

    //START--CATEGORY LISTING FUNCTION
    public function products($url = null)
    {
        // show 404 page if category url does not exist or category status is disabled
        $countCategory = Category::where(['url' => $url, 'status' => 1])->count();
        //echo $countCategory; die;
        if ($countCategory == 0) {
            abort(404);
        }
        // get all categories and subcategories along with the 'categories' relationship
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();
        $categoriesDetails = Category::where(['url' => $url])->first(); //get all categories  by url

        //start --- check category/subcategory url
        if ($categoriesDetails->parent_id == 0) {
            //if url is main category url
            $subcategories = Category::where(['parent_id' => $categoriesDetails->id])->get();
            //$cat_id="";
            foreach ($subcategories as $subcat) {
                $cat_id[] = $subcat->id;
                # code...
            }
            //print_r($cat_id); die;
            // get and display only product whose status value=1
            $productsAll = Product::whereIn('products.category_id', $cat_id)->where('products.status', 1)->orderBy('products.id', 'Desc');//->paginate(3);
            //$productsAll = json_decode(json_encode($productsAll));
            //echo "<pre>"; print_r($productsAll); die;

              //Breadcrumb
           $breadcrumb = "<a href ='/'> Home </a> > <a href='" . $categoriesDetails->url ."'> " . $categoriesDetails->name ."</a>";


        } else {
            //if url is sub category url  and status value=1
            $productsAll = Product::where(['products.category_id' => $categoriesDetails->id])->where('products.status', 1)->orderBy('products.id', 'Desc'); //->paginate(3);

            //Breadcrumb
            $mainCatBreadcrumb = Category::whereId($categoriesDetails->parent_id)->first();
            $breadcrumb = "<a href ='/'> Home </a> > <a href='" . $mainCatBreadcrumb->url ."'> " . $mainCatBreadcrumb->name ."</a> > <a href='" . $categoriesDetails->url ."'> " . $categoriesDetails->name ."</a>";


        }

        // check for product colors in product table
        if (!empty($_GET['colors'])) {
            $colorArray = explode('_', $_GET['colors']);
            $productsAll = $productsAll->wherein('products.product_color', $colorArray);
        }

        // check for product sleeves in product table
        if (!empty($_GET['sleeves'])) {
            $sleeveArray = explode('_', $_GET['sleeves']);
            $productsAll = $productsAll->wherein('products.sleeve', $sleeveArray);
        }

        // check for product pattern in product table
        if (!empty($_GET['patterns'])) {
            $patternArray = explode('_', $_GET['patterns']);
            $productsAll = $productsAll->wherein('products.pattern', $patternArray);
        }

        $productsAll = $productsAll->paginate(6);
        //$colorArray = array('Black','Blue','Brown','Green','Yellow','Pink','Purple','Red','Silver','White','Orange','Ash','Gold');
        $colorArray = Product::select('product_color')->groupBy('product_color')->get(); //return only product colors in db but unique
        $colorArray = array_flatten(json_decode(json_encode($colorArray), true)); // convert multiple array to a single array

        $sleeveArray = Product::select('sleeve')->where('sleeve', '!=', '')->groupBy('sleeve')->get(); //return only product sleeves in db but unique
        $sleeveArray = array_flatten(json_decode(json_encode($sleeveArray), true));

        $patternArray = Product::select('pattern')->where('pattern', '!=', '')->groupBy('pattern')->get(); //return only product patterns in db but unique
        $patternArray = array_flatten(json_decode(json_encode($patternArray), true));
        //return $sleeveArray;
        //end --- check category/subcategory url

        //Start--Catgeories/subcategories Meta tags for SEO
        $meta_title = $categoriesDetails->meta_title;
        $meta_description = $categoriesDetails->meta_description;
        $meta_keywords = $categoriesDetails->meta_keywords;
        //Ends--Catgeories/subcategories Meta tags for SEO
        return view('products.listing')->with(compact('categoriesDetails', 'productsAll', 'categories', 'meta_title', 'meta_description', 'meta_keywords', 'url', 'colorArray', 'sleeveArray','patternArray','breadcrumb'));
    }
    //END--CATEGORY LISTING FUNCTION

    // Search for products function on front_header
    public function searchProducts(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // get all categories and subcategories along with the 'categories' relationship
            $categories = Category::with('categories')->where(['parent_id' => 0])->get();
            //$categories = Category::with('categories')->where(['parent_id'=>0])->get();
            $search_product = $data['product']; // search variable
            //Start --This compare user to enter a search item name
            if (empty($search_product)) {
                return redirect()->back()->with('flash_err_msg', 'Please enter search item name!');
            }
            //End --This compare user to enter a search item name

            // Search using product name and code to display only product whose status value=1

            $productsAll = product::where(function ($query) use ($search_product) {
                $query->where('product_name', 'like', '%' . $search_product . '%')
                    ->orwhere('product_color', 'like', '%' . $search_product . '%')
                    ->orwhere('description', 'like', '%' . $search_product . '%');
            })->where('status', 1)->get();

            return view('products.listing')->with(compact('search_product', 'productsAll', 'categories'));
        }

    }

    // GET PRODUCT DETAILS
    public function product($id = null)
    {
        // show 404 page if product is disabled
        $productsCount = Product::where(['id' => $id, 'status' => 1])->count();
        if ($productsCount == 0) {
            abort(404);
        }
        //get product details
        $productDetails = Product::with('attributes')->where(['id' => $id])->first();
        // $productDetails = json_decode(json_encode( $productDetails));
        //echo "<pre>"; print_r( $productDetails); die;

        /*get related/Recommended products to be display on product 'detail' page
        NB: No repetition and as such the main product will not display under Recommended items.
         */
        $relatedProducts = Product::where('id', '!=', $id)->where(['category_id' => $productDetails->category_id])->get();
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
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();

        //get product alternate images
        $productsAltImages = ProductsImage::where('product_id', $id)->get();

        //get total stock of the product
        $total_stock = ProductsAttribute::where('product_id', $id)->sum('stock');

        //Start--Product detail Meta tags for SEO
        $meta_title = $productDetails->product_name;
        $meta_description = $productDetails->description;
        $meta_keywords = $productDetails->care;
        //Ends--Product detail Meta tags for SEO
        return view('products.detail')->with(compact('productDetails', 'categories', 'productsAltImages', 'total_stock', 'relatedProducts', 'meta_title', 'meta_description', 'meta_keywords', 'url'));
    }

    public function filter(Request $request)
    {

        // $data= $request->all();
        // return $data;
        // Colors filter
        $colorUrl = "";
        if (!empty($request['colorFilter'])) {
            foreach ($request['colorFilter'] as $colors) {
                if (empty($colorUrl)) {
                    $colorUrl = "&colors=" . $colors;
                } else {
                    $colorUrl .= "_" . $colors;
                }

            }
            $finalUrl = "products/" . $request['url'] . "?" . $colorUrl;
            return redirect::to($finalUrl);
        }
        // Sleeves filter
        $sleeveUrl = "";
        if (!empty($request['sleeveFilter'])) {
            foreach ($request['sleeveFilter'] as $sleeves) {
                if (empty($sleeveUrl)) {
                    $sleeveUrl = "&sleeves=" . $sleeves;
                } else {
                    $sleeveUrl .= "_" . $sleeves;
                }

            }
            $finalUrl = "products/" . $request['url'] . "?" . $sleeveUrl;
            return redirect::to($finalUrl);
        }

         // Pattern filter
         $patternUrl = "";
         if (!empty($request['patternFilter'])) {
             foreach ($request['patternFilter'] as $patterns) {
                 if (empty($patternUrl)) {
                     $patternUrl = "&patterns=" . $patterns;
                 } else {
                     $patternUrl .= "_" . $patterns;
                 }
 
             }
             $finalUrl = "products/" . $request['url'] . "?" . $patternUrl;
             return redirect::to($finalUrl);
         }
    }
    // ()get product prices according to selected size
    public function getProductPrice(Request $request)
    {
        $data = $request->all();
        //echo "<pre>"; print_r($data);die;
        $proArr = explode("-", $data['idSize']);
        //echo $proArr[0]; echo $proArr[1];die;
        $proAttr = ProductsAttribute::where(['product_id' => $proArr[0], 'size' => $proArr[1]])->first();

        //get currency conversion rate
        $getcurrencyRate = Product::getcurrencyRate($proAttr->price);
        echo $proAttr->price . "-" . $getcurrencyRate['USD_rates'] . "-" . $getcurrencyRate['EUR_rates'] . "-" . $getcurrencyRate['GHC_rates'];

        //get attribute stock
        echo "#";
        echo $proAttr->stock;

    }

    //ADD TO CART FUNCTION
    public function addtocart(Request $request)
    {
        // Initially empty/delete 'couponAmount' and 'couponCode' variable values from the session
        Session::forget('couponAmount');
        Session::forget('couponCode');

        $data = $request->all();

        //If no size is selected before adding to cart then display error message
        if (empty($data['size'])) {
            return redirect()->back()->with('flash_err_msg', 'Please select a size! Thank you!');
        }
        //START----Check if product stock is available or not or less dan user demanded quantity
        $product_size = explode("-", $data['size']); //seperate d size frm id and Display only size name
        $getProductStock = ProductsAttribute::where(['product_id' => $data['product_id'], 'size' => $product_size[1]])->first();
        //echo $getProductStock->stock;die;
        if ($getProductStock->stock < $data['quantity']) {
            return redirect()->back()->with('flash_err_msg', 'Required quantity is not available at the monment!');
        }

        // if users' supplied quantity is less than one
        if ($data['quantity'] < 1) {
            return redirect()->back()->with('flash_err_msg', 'Invalid quantity! please enter a valid quantity');
        }
        //END----Check if product stock is available or not or less dan user demanded quantity

        /*
        if user mail is empty. This allows products from users cart to be to specific to each user and allowed items added to cart to be displayed immediately. If user is not login submit empty string to user_email field else submit user email to user_email field.

        NB: The cart blade is included in the Route::group(['middleware'=>['frontlogin']] function(i.e user must always login before he/she can add items to cart), hence, user email will always be submitted to user_email field
         */
        if (empty(Auth::user()->email)) {
            $data['user_email'] = '';
        } else {
            $data['user_email'] = Auth::user()->email;
        }

        // if session_id does not exist, then creat one else use the existing session_id
        $session_id = Session::get('session_id');
        if (empty($session_id)) {
            $session_id = str_random(40); //die; //generate random strings
            Session::put('session_id', $session_id); // session variable

        }
        $sizeArr = explode("-", $data['size']); //send only the size name to cart table not (id-size, e.g 4-medium)

        /*
        NB: If the cart blade is not included in the Route::group(['middleware'=>['frontlogin']] function(i,e if user is not login), this will be necessary.

        if(empty(Auth::check())){
        // to prevent duplicate of cart products in thesame session i.e having thesame seesion_id
        $countProducts =DB::table('cart')->where(['product_id'=>$data['product_id'],'product_color'=>$data['product_color'],'size'=>$sizeArr[1],'session_id'=>$session_id])->count();//die;

        //if product does not exist for that session then add product else redirect
        if($countProducts >0){
        return redirect()->back()->with('flash_err_msg','Product Already Exists in Cart!');
        }

        }else{
        // to prevent duplicate of cart products in thesame session i.e having thesame seesion_id
        $countProducts =DB::table('cart')->where(['product_id'=>$data['product_id'],'product_color'=>$data['product_color'],'size'=>$sizeArr[1],'user_email'=>$data['user_email']])->count();//die;

        //if product does not exist for that session then add product else redirect
        if($countProducts >0){
        return redirect()->back()->with('flash_err_msg','Product Already Exists in Cart!');
        }

        }

         */

        // to prevent duplicate of cart products in thesame session i.e having thesame seesion_id
        $countProducts = DB::table('cart')->where(['product_id' => $data['product_id'], 'product_color' => $data['product_color'], 'size' => $sizeArr[1], 'session_id' => $session_id])->count(); //die;

        //if product does not exist for that session then add product else redirect
        if ($countProducts > 0) {
            return redirect()->back()->with('flash_err_msg', 'Product Already Exists in Cart!');
        } else {
            //get and add product sku to cart table instead of product code
            $getSKU = ProductsAttribute::select('sku')->where(['product_id' => $data['product_id'], 'size' => $sizeArr[1]])->first();

            // Insert into cart table
            DB::table('cart')->insert(['product_id' => $data['product_id'], 'product_name' => $data['product_name'], 'product_code' => $getSKU->sku, 'product_color' => $data['product_color'], 'price' => $data['price'], 'size' => $sizeArr[1], 'quantity' => $data['quantity'], 'user_email' => $data['user_email'], 'session_id' => $session_id]); //die;

        }
        return redirect('cart')->with('flash_success_msg', 'Product Added in Cart Successfully!.');
    }

    // DISPLAY CART ITEMS AND IMAGES FROM CART TABLE ON CART BLADE FILE
    public function cart()
    {

        //Display products from user cart table when user is logged in by comparing user_email, odawize take usersession_id

        //$session_id = Session::get('session_id');
        if (Auth::check()) {
            $user_email = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email' => $user_email])->get();
        } else {
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();
        }

        /*
        $session_id = Session::get('session_id');
        $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
         */

        // get and display each cart item product image
        foreach ($userCart as $key => $product) {
            //echo $product->product_id;
            $productDetails = Product::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }

        //Start--cart Meta tags for SEO
        $meta_title = "Shopping Cart - E-com website";
        $meta_description = "Viewing Shopping Cart - E-com website";
        $meta_keywords = "Shopping Cart,E-com website";
        //Ends--cart Meta tags for SEO
        return view('products.cart')->with(compact('userCart', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    //UPDATE CART QUANTITY FUNCTION
    public function updateCartQuantity($id = null, $quantity = null)
    {
        // Initially empty/delete 'couponAmount' and 'couponCode' variable values from the session
        Session::forget('couponAmount');
        Session::forget('couponCode');

        $getCartDetails = DB::table('cart')->where('id', $id)->first(); //get cart details fron cart table
        $getAttributeStock = ProductsAttribute::where('sku', $getCartDetails->product_code)->first(); //get attribute stock from productAttribute table

        $updated_quantity = $getCartDetails->quantity + $quantity; // get user demanded quantity

        // if total sku is greater than or equal to the quantity demanded by user
        if ($getAttributeStock->stock >= $updated_quantity) {
            DB::table('cart')->where('id', $id)->increment('quantity', $quantity);
            return redirect('cart')->with('flash_success_msg', 'Product Quantity has been Update Successfully!');
        } else {
            return redirect()->back()->with('flash_err_msg', 'Required product Quantity is not Available!');
        }

    }
    //DELETE PRODUCT(S) FROM CART FUNCTION

    public function deleteCartProduct($id = null)
    {
        // Initially empty/delete 'couponAmount' and 'couponCode' variable values from the session
        Session::forget('couponAmount');
        Session::forget('couponCode');

        //echo $id;die;
        DB::table('cart')->where('id', $id)->delete();
        return redirect('cart')->with('flash_success_msg', 'Product has been Deleted from Cart Successfully!');

    }

    //APPLY COUPON
    public function applyCoupon(Request $request)
    {
        // Initially empty/delete 'couponAmount' and 'couponCode' variable values from the session
        Session::forget('couponAmount');
        Session::forget('couponCode');
        $data = $request->all();
        $couponCount = Coupon::where('coupon_code', $data['coupon_code'])->count(); //count available coupons
        // check user entered coupon codes from cart blade to that of coupons table
        if ($couponCount == 0) {
            return redirect()->back()->with('flash_err_msg', 'This Coupon does not exists!');
        } else {
            // perform othe checks like active/inactive, expiry date, etc
            $couponDetails = Coupon::where('coupon_code', $data['coupon_code'])->first(); //get coupon details

            //if coupon is active
            if ($couponDetails->status == 0) {
                return redirect()->back()->with('flash_err_msg', 'This Coupon is Inactive!');
            }

            // if coupon has expired
            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');
            if ($expiry_date < $current_date) {
                return redirect()->back()->with('flash_err_msg', 'This Coupon has Expired!');
            }
            // coupon is valid for discount

            /*
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
             */

            //Display products from user cart table when user is logged in by comparing user_email, odawize take usersession_id
            //$session_id = Session::get('session_id');
            if (Auth::check()) {
                $user_email = Auth::user()->email;
                $userCart = DB::table('cart')->where(['user_email' => $user_email])->get();
            } else {
                $session_id = Session::get('session_id');
                $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();
            }

            $total_amount = 0; // get cart total amount
            foreach ($userCart as $item) {
                $total_amount = $total_amount + ($item->price * $item->quantity);
            }
            // check if amout type is fixed or percentage
            if ($couponDetails->amount_type == 'fixed') {
                $couponAmount = $couponDetails->amount;
            } else {
                $couponAmount = $total_amount * ($couponDetails->amount / 100);
            }

            //Add coupon code and amount in session
            Session::put('couponAmount', $couponAmount);
            Session::put('couponCode', $data['coupon_code']);
            return redirect()->back()->with('flash_success_msg', 'Coupon code successfully applied.you are availing discount!');
        }

    }
    //checkout function

    public function checkout(Request $request)
    {
        $user_id = Auth::user()->id; // get auth user id
        $user_email = Auth::user()->email; // get auth user email
        $userDetails = User::find($user_id); //get user details
        //echo "<pre>"; print_r($userDetails); die;
        $countries = Country::get(); // get all countries from 'countries' table

        // check if shipping address aready exists
        $shippingCount = DeliveryAddress::where('user_id', $user_id)->count();
        $shippingDetails = array();
        if ($shippingCount > 0) {
            //return redirect()->back()->with('flash_err_msg','This Coupon does not exists!');
            $shippingDetails = DeliveryAddress::where('user_id', $user_id)->first(); //get coupon details
        }
        //update cart table with user email
        $session_id = Session::get('session_id');
        DB::table('cart')->where(['session_id' => $session_id])->update(['user_email' => $user_email]);

        if ($request->ismethod('post')) {
            $data = $request->all();

            // return to checkout page if any of the below field(s) is empty
            if (empty($data['billing_name']) || empty($data['billing_address']) || empty($data['billing_city']) || empty($data['billing_state']) || empty($data['billing_country']) || empty($data['billing_pincode']) || empty($data['billing_mobile']) || empty($data['shipping_name']) || empty($data['shipping_address']) || empty($data['shipping_city']) || empty($data['shipping_state']) || empty($data['shipping_country']) || empty($data['shipping_pincode']) || empty($data['shipping_mobile'])) {

                return redirect()->back()->with('flash_err_msg', 'Pls fill all fields to checkout!');

            }
            // update user details
            User::where('id', $user_id)->update(['name' => $data['billing_name'], 'address' => $data['billing_address'], 'city' => $data['billing_city'], 'state' => $data['billing_state'], 'country' => $data['billing_country'], 'pincode' => $data['billing_pincode'], 'mobile' => $data['billing_mobile']]);

            //return redirect()->back()->with('flash_success_msg','Account details has been Successfully Updated!');

            if ($shippingCount > 0) {
                // update shipping address
                DeliveryAddress::where('user_id', $user_id)->update(['name' => $data['shipping_name'], 'address' => $data['shipping_address'], 'city' => $data['shipping_city'], 'state' => $data['shipping_state'], 'country' => $data['shipping_country'], 'pincode' => $data['shipping_pincode'], 'mobile' => $data['shipping_mobile']]);
            } else {
                //add new shipping address
                $shipping = new DeliveryAddress;
                $shipping->user_id = $user_id;
                $shipping->user_email = $user_email;
                $shipping->name = $data['shipping_name'];
                $shipping->address = $data['shipping_address'];
                $shipping->city = $data['shipping_city'];
                $shipping->state = $data['shipping_state'];
                $shipping->country = $data['shipping_country'];
                $shipping->pincode = $data['shipping_pincode'];
                $shipping->mobile = $data['shipping_mobile'];
                $shipping->save();
            }

            // compare user entered pincode to determine if shipping location is available or not
            $pincodeCount = Zipcode::where('zipcode', $data['shipping_pincode'])->count();
            if ($pincodeCount == 0) {
                return redirect()->back()->with('flash_err_msg', 'Your location is not available for delivery.Please choose another location.');
            }
            //echo "Redirect to order review page";die;
            return redirect()->action('ProductsController@orderReview');
        }
        $meta_title = "Checkout - Ecom website"; //meta tag for SEO
        return view('products.checkout')->with(compact('countries', 'userDetails', 'shippingDetails', 'meta_title'));
    }

    //order review function
    public function orderReview()
    {
        $user_id = Auth::user()->id; // get auth user id
        $user_email = Auth::user()->email; // get auth user email
        $userDetails = User::find($user_id); //get user details
        $countries = Country::get(); // get all countries from 'countries' table
        $shippingDetails = DeliveryAddress::where('user_id', $user_id)->first(); //get shipping details

        // get cart details
        $userCart = DB::table('cart')->where(['user_email' => $user_email])->get();

        // get and display each cart item product image
        foreach ($userCart as $key => $product) {
            //echo $product->product_id;
            $productDetails = Product::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
        /*compare user entered COD/Prepaid pincode to determine if shipping location is available or not,
        if yess, show and allow user to select payment method*/
        $cod_pincodeCount = CodZipcode::where('zipcode', $shippingDetails->pincode)->count();
        $prepaid_pincodeCount = PrepaidZipcode::where('zipcode', $shippingDetails->pincode)->count();

        $meta_title = "Order Review - Ecom website"; //meta tag for SEO
        return view('products.order_review')->with(compact('userDetails', 'shippingDetails', 'countries', 'userCart', 'meta_title', 'cod_pincodeCount', 'prepaid_pincodeCount'));
    }

    // place order
    public function placeOrder(Request $request)
    {
        // send user order details to orders table
        if ($request->ismethod('post')) {
            $data = $request->all();
            $user_id = Auth::user()->id; // get auth user id
            $user_email = Auth::user()->email; // get auth user email
            $shippingDetails = DeliveryAddress::where(['user_email' => $user_email])->first(); //get shipping details

            // compare user entered pincode to determine if shipping location is available or not
            $pincodeCount = Zipcode::where('zipcode', $shippingDetails->pincode)->count();
            if ($pincodeCount == 0) {
                return redirect()->back()->with('flash_err_msg', 'Your location is not available for delivery.Please choose another location.');
            }

            // get coupon code and amount from session variables
            if (empty(Session::get('couponCode'))) {
                $coupon_code = '';
            } else {
                $coupon_code = Session::get('couponCode');
            }
            if (empty(Session::get('couponAmount'))) {
                $coupon_amount = '';
            } else {
                $coupon_amount = Session::get('couponAmount');
            }

            // insert into orders table
            $order = new Order;
            // user details
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            //shipping details
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->city = $shippingDetails->city;
            $order->state = $shippingDetails->state;
            $order->pincode = $shippingDetails->pincode;
            $order->country = $shippingDetails->country;
            $order->mobile = $shippingDetails->mobile;
            // paynemt details
            $order->coupon_code = $coupon_code;
            $order->coupon_amount = $coupon_amount;
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            $order->grand_total = $data['grand_total'];
            $order->save();

            //Insert into orders_products table

            $order_id = Db::getPdo()->lastInsertId();
            $cartproducts = DB::table('cart')->where(['user_email' => $user_email])->get();
            foreach ($cartproducts as $pro) {
                $cartPro = new OrdersProduct;
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_code = $pro->product_code;
                $cartPro->product_name = $pro->product_name;
                $cartPro->product_color = $pro->product_color;
                $cartPro->product_size = $pro->size;
                $cartPro->product_price = $pro->price;
                $cartPro->product_qty = $pro->quantity;
                $cartPro->save();

                //Start Reduce product stock quantity after each order
                
                $get_product_stock = ProductsAttribute::where('sku',$pro->product_code)->first();
                $new_stock = $get_product_stock->stock - $pro->quantity;
                ProductsAttribute::where('sku',$pro->product_code)->update(['stock'=>$new_stock]);
                
                //Stop Reduce product stock quantity after each order



            }

            // create/ start session variable to get order_id and grand_total on COD thank you page
            Session::put('order_id', $order_id);
            Session::put('grand_total', $data['grand_total']);

            // Payment page conditions
            if ($data['payment_method'] == 'COD') {
                // get product details
                $productDetails = Order::with('orders')->where('id', $order_id)->first();
                $userDetails = User::where('id', $user_id)->first(); //get user details
                // Start....Code for order email
                $email = $user_email;
                $messageData = [
                    'email' => $email,
                    'name' => $shippingDetails->name,
                    'order_id' => $order_id,
                    'productDetails' => $productDetails,
                    'userDetails' => $userDetails,
                ];
                Mail::send('emails.order', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Order Placed- E-com website');
                });
                // End....Code for order email
                return redirect('/thanks'); //redirect user to thank you page after saving order
            } else {
                return redirect('/paypal'); //redirect to paypal page after saving orders
            }
        }
    }

    // COD thank you page
    public function thanks(Request $request)
    {
        // empty shopping cart after user has placed orders
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email', $user_email)->delete();
        return view('orders.thanks');
    }

    // paypal thank you page
    public function paypal(Request $request)
    {
        //empty shopping cart after user has placed orders
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email', $user_email)->delete();
        return view('orders.paypal');
    }

    // user orders page
    public function userOrders(Request $request)
    {
        $user_id = Auth::user()->id; // get user id
        $orders = Order::with('orders')->where('user_id', $user_id)->orderBy('id', 'DESC')->get(); //get all user orders
        //dump($orders);
        return view('orders.user_orders')->with(compact('orders'));
    }

    // user order details page userOrderDetails
    public function userOrderDetails($order_id = null)
    {
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('id', $order_id)->first();
        //dump($orderDetails);
        return view('orders.user_order_details')->with(compact('orderDetails'));

    }

    // view user orders viewOrder
    public function viewOrders()
    {

        $orders = Order::with('orders')->orderBy('id', 'desc')->get();
        return view('admin.orders.view_orders')->with(compact('orders'));
    }

    // Admin view order details page viewOrderDetails
    public function viewOrdersDetails($order_id)
    {
        $orderDetails = Order::with('orders')->where('id', $order_id)->first();
        $user_id = $orderDetails->user_id; // get user id
        // compare user id and get user details if matched
        $userDetails = User::where('id', $user_id)->first();
        return view('admin.orders.order_details')->with(compact('orderDetails', 'userDetails'));
    }

    // Admin generate invoice
    public function viewOrdersInvoice($order_id)
    {
        $orderDetails = Order::with('orders')->where('id', $order_id)->first();
        $user_id = $orderDetails->user_id; // get user id
        // compare user id and get user details if matched
        $userDetails = User::where('id', $user_id)->first();
        return view('admin.orders.order_invoice')->with(compact('orderDetails', 'userDetails'));
    }

    // Admin update order status
    public function updateOrderStatus(Request $request)
    {
        if ($request->ismethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            Order::where('id', $data['order_id'])->update(['order_status' => $data['order_status']]);
            return redirect()->back()->with('flash_success_msg', 'Order status has been updated successfully!');
        }
    }

    public function checkZipcode(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // compare users' enter code to that pf db
            echo $pincodeCount = Zipcode::where('zipcode', $data['zipcode'])->count();
        }

    }

}
