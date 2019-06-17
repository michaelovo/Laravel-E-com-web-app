<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
// Start----frontend route




// End----frontend rou

//Route::get('/admin','AdminController@login');
Route::match(['get','post'],'/admin','AdminController@login');


Auth::routes();
// Indexpage route
Route::get('/', 'IndexController@index');
Route::get('/home', 'HomeController@index')->name('home');

//Category Listing page route
Route::get('/products/{url}', 'ProductsController@products');

//product detail page route
Route::get('/product/{id}', 'ProductsController@product');

//Add to cart route
 Route::match(['get','post'],'/add-cart','ProductsController@addtocart');
 
 // cart page route
 Route::match(['get','post'],'/cart','ProductsController@cart');

 //Edit/Update product quantity in cart route
Route::get('/cart/update-product/{id}/{quantity}', 'ProductsController@updateCartQuantity');

 //Delete cart item route
Route::get('/cart/delete-product/{id}', 'ProductsController@deleteCartProduct');


//get product attribute price
Route::get('/get-product-price', 'ProductsController@getProductPrice');


Route::group(['middleware'=>['auth']],function(){
  Route::get('/admin/dashboard','AdminController@dashboard');
  Route::get('/admin/settings','AdminController@settings');
  Route::get('/admin/check-pwd','AdminController@checkPwd');
  Route::match(['get','post'],'/admin/update-pwd','AdminController@updatepassword');

  //Admin category route
  Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
  Route::get('/admin/view-category','CategoryController@viewCategories');
  Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
  Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');

  //Admin product route
   Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
   Route::get('/admin/view-product','ProductsController@viewProducts');
   Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
   Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');
   Route::match(['get','post'],'/admin/delete-product/{id}','ProductsController@deleteProduct');
   


   // Products attributes route
    Route::match(['get','post'],'/admin/add-attributes/{id}','ProductsController@addAttributes');
    Route::match(['get','post'],'/admin/edit-attributes/{id}','ProductsController@editAttributes');
    Route::get('/admin/delete-attribute/{id}','ProductsController@deleteAttributes');

   // Admin products alternate images
    Route::match(['get','post'],'/admin/add-images/{id}','ProductsController@addImages');
    Route::get('/admin/delete-alt-image/{id}','ProductsController@deleteAltImage');


    //Admin Coupons route
     Route::match(['get','post'],'/admin/add-coupon','CouponController@addCoupon');//add coupon
     Route::get('/admin/view-coupon','CouponController@viewCoupons'); //view coupons
     Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponController@editCoupon'); //edit/update coupon
     Route::get('/admin/delete-coupon/{id}','CouponController@deleteCoupon');

     Route::post('/cart/apply-coupon','ProductsController@applyCoupon'); //Apply coupon

     //Admin Banners Route
     Route::match(['get','post'],'/admin/add-banner','BannersController@addBanner');//add banners
     Route::get('/admin/view-banner','BannersController@viewBanners'); //view banners
     Route::match(['get','post'],'/admin/edit-banner/{id}','BannersController@editBanner');//edit/update banner
     Route::get('/admin/delete-banner/{id}','BannersController@deleteBanner');// delete banner

   



});

Route::get('/logout','AdminController@logout');
