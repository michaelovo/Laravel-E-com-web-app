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

   



});

Route::get('/logout','AdminController@logout');
