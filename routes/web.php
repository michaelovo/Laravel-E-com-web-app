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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/admin','AdminController@login');
Route::match(['get','post'],'/admin','AdminController@login');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

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
   Route::match(['get','post'],'/admin/delete-product/{id}','ProductsController@deleteProduct');

});

Route::get('/logout','AdminController@logout');
