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

Route::get('/','ViewDetailsController@index');

Auth::routes();
  
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/view_profile', 'HomeController@view_profile');
Route::post('/edit_profile', 'HomeController@edit_profile')->name('edit_profile');
Route::get('/give_post', 'HomeController@give_post');

Route::post('/submit_post', 'HomeController@submit_post')->name('submit_post');
Route::post('/update_post', 'HomeController@submit_update_post')->name('submit_update_post');
Route::get('/edit_post/{id}', 'HomeController@edit_post')->name('edit_post');
Route::get('/delete_post/{id}', 'HomeController@delete_post')->name('delete_post');
Route::get('/view_details/{id}', 'ViewDetailsController@view_details')->name('view_details');
Route::get('/booking/{id}', 'PaymentController@booking')->name('booking');



//...payment

Route::get('/give_payment', 'HomeController@give_paymentss');
Route::post('/save_payment','PaymentController@save_paymentss')->name('submit_payment');  

Route::get('/search','ViewDetailsController@search')->name('search');
Route::get('view_map/{address}','ViewDetailsController@view_map')->name('view_map');
//admin.......................

Route::get('admin_login',function(){return view('auth.admin_login');});
Route::post('admin_login','AdminController@login')->name('admin_login');

Route::prefix('admin')->group(function () {
	//start admin middleware.........
 Route::middleware('admin')->group(function () {
  
   Route::get('home','AdminController@home');
   Route::get('all_users','AdminController@all_users');
   Route::get('view_user_info/{id}','AdminController@view_user_info')->name('view_user_info');
    Route::get('approve_post/{id}','AdminController@approve_post')->name('approve_post');
    Route::get('deactive_post/{id}','AdminController@deactive_post')->name('deactive_post');
   Route::get('edit_user_info/{id}','AdminController@edit_user_info')->name('edit_user_info');
   Route::post('edit_user_info/{id}','AdminController@update_user_info')->name('edit_user_info');
   Route::get('delete_user_info/{id}','AdminController@delete_user_info')->name('delete_user_info');
   Route::get('all_posts','AdminController@all_posts');
   Route::get('view_user_post/{id}','AdminController@view_user_post')->name('view_user_post');
   Route::get('user_posts/{user_id}','AdminController@user_posts')->name('user_posts');
   Route::get('delete_user_post/{id}','AdminController@delete_user_post')->name('delete_user_post');
   Route::post('update_status','AdminController@update_status');
   Route::get('all_payment','PaymentController@all_payment');  
  

  
});   
//end admin middleware................
});
