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

// products filter
Route::match(['get','post'],'/products-filter', 'ProductsController@filter');

//product detail page route
Route::get('/product/{id}', 'ProductsController@product');


//get product attribute price
Route::get('/get-product-price', 'ProductsController@getProductPrice');
//check zipcode availability
Route::post('/check-zipcode','ProductsController@checkZipcode');


//Search product route
Route::post('/search-products', 'ProductsController@searchProducts');


//START--FRONTEND USERS ROUTE

	//login/ register routes
Route::get('/login-register','UsersController@userLoginRegister');	//register_login page
Route::post('/user-register','UsersController@register');	//user register form
Route::match(['get','post'],'/check-email','UsersController@checkEmail'); //check if user email already exists
Route::post('user-login','UsersController@login');	// user login
Route::get('/user-logout','UsersController@logout');	// user logout
Route::get('confirm/{code}','UsersController@confirmAccount');	// user Confirm account
Route::match(['get','post'],'/forgot-password','UsersController@forgotPassword'); //Forgot password


	//FRONTEND MIDDLEWARE---All user route after login
Route::group(['middleware'=>['frontlogin']],function(){
	Route::match(['get','post'],'account','UsersController@account');//User account page
	Route::get('/check-user-pwd','UsersController@chkUserPwd'); //check user current against old password
  	Route::match(['get','post'],'/update-user-pwd','UsersController@updateUserPwd'); //update user pwd

	// All cart routes
	Route::match(['get','post'],'/add-cart','ProductsController@addtocart');//Add to cart route
 	Route::match(['get','post'],'/cart','ProductsController@cart');// cart page route
	Route::get('/cart/update-product/{id}/{quantity}', 'ProductsController@updateCartQuantity'); //Edit/Update product quantity in cart route
	Route::get('/cart/delete-product/{id}', 'ProductsController@deleteCartProduct'); //Delete cart item route

	//checkout page route
  	Route::match(['get','post'],'checkout','ProductsController@checkout');
  	Route::match(['get','post'],'/order-review','ProductsController@orderReview'); // order review page

  	//place order
  	Route::match(['get','post'],'/place-order','ProductsController@placeOrder'); // place order
  	Route::get('/orders', 'ProductsController@userOrders'); //User orders page
  	Route::get('/orders/{id}', 'ProductsController@userOrderDetails'); //User orders products page


  	//payment route
  	Route::get('/thanks', 'ProductsController@thanks'); //COD thank you page
  	Route::get('/paypal', 'ProductsController@paypal'); //paypal thank you page

});
//END---FRONTEND USERS ROUTE

Route::group(['middleware'=>['adminlogin']],function(){
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
   Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');//add product
   Route::get('/admin/view-product','ProductsController@viewProducts');//view products
   Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');//edit products
   Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');//delete product image from folder
	 Route::get('/admin/delete-product-video/{id}','ProductsController@deleteProductVideo');//delete product video from folder
   Route::match(['get','post'],'/admin/delete-product/{id}','ProductsController@deleteProduct');//delete product

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
     Route::match(['get','post'],'/admin/edit-banner/{id}','BannersController@editBanner');//edi/update banners
     Route::get('/admin/delete-banner-image/{id}','BannersController@deleteBannerImage');
     Route::get('/admin/delete-banner/{id}','BannersController@deleteBanner');//delete banner


     //Admin order route
     Route::get('/admin/view-order','ProductsController@viewOrders');//view orders
     Route::get('/admin/view_order/{id}','ProductsController@viewOrdersDetails');//view orders details
     Route::post('/admin/update-order-status','ProductsController@updateOrderStatus');//update orders status


     // Admin Invoice route
     Route::get('/admin/view-order-invoice/{id}','ProductsController@viewOrdersInvoice');//Invoice details

     //Admin user routes
     Route::get('/admin/view-users','UsersController@viewUsers');// view users

     //CMS pages route
     Route::match(['get','post'],'/admin/add-cms-page','CmsPagesController@addCmsPage');//add cms page
     Route::get('/admin/view-cms-pages','CmsPagesController@viewCmsPages'); //view cms pages
     Route::match(['get','post'],'/admin/edit-cms-page/{id}','CmsPagesController@editCmsPage');//Edit cms pages
     Route::match(['get','post'],'/admin/delete-cms-page/{id}','CmsPagesController@deleteCmsPage');//delete cms page

     //Currency pages route
     Route::get('/admin/add-currency','CurrencyController@index');
     Route::post('/admin/add-currency','CurrencyController@store');
     Route::get('/admin/view_currencies','CurrencyController@viewCurrency');
     Route::get('/admin/edit-currency/{id}','CurrencyController@editCurrency');
     Route::post('/admib/update-currency/{id}','CurrencyController@updateCurrency');
     Route::get('/admin/delete-currency/{id}','CurrencyController@deleteCurrency');



     //shipping charges route
     Route::get('/admin/add-charges','ShippingChargeController@index');
     Route::post('/admin/add-charges','ShippingChargeController@store');
     Route::get('/admin/view_charges','ShippingChargeController@viewCharges');
     Route::get('/admin/edit-charges/{id}','ShippingChargeController@editCharges');
     Route::post('/admin/update-charges/{id}','ShippingChargeController@updateCharges');
     Route::get('/admin/delete-charges/{id}','ShippingChargeController@deleteCharges');

});

Route::get('/logout','AdminController@logout');


// Display contact page
 Route::match(['get','post'],'/pages/contact','CmsPagesController@contact');//delete cms page
// Display post page for vue js
 Route::match(['get','post'],'/pages/post','CmsPagesController@addPost');//delete cms page

// CMS pages route
 Route::match(['get','post'],'/pages/{url}','CmsPagesController@CmsPages');//delete cms page
