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
    return view('index');
});

//home
Route::get('/index', 'HomeController@index');
Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact');
Route::get('/service', 'HomeController@service');
Route::get('/blog', 'HomeController@blog');
Route::get('/search','HomeController@search');
Route::post('/search/result','HomeController@search_operation')->name('search_operation');

//petshop
Route::get('/petshop/login','PetshopController@show_login');
Route::get('/petshop/register','PetshopController@show_register');
Route::post('/register_petshop','PetshopController@create')->name('create_petshop');
Route::post('/login_petshop','PetshopController@login')->name('login_petshop');
Route::get('/logout_petshop','PetshopController@logout')->name('logout_petshop');
Route::get('/dashboard','DashboardController@show_dashboard');
Route::get('/petshop/profile','PetshopController@show_profile');

//petshop product
Route::get('/petshop/products','ProductController@product_petshop_list');
Route::post('/petshop/product/add','ProductController@add_product_petshop')->name('add_product_petshop');

//petshop care
Route::get('/petshop/cares','CareController@care_petshop_list');
Route::post('/petshop/care/add','CareController@add_care_petshop')->name('add_care_petshop');

//petshop pet
Route::get('/petshop/pets','PetController@pet_petshop_list');
Route::post('/petshop/pet/add','PetController@add_pet_petshop')->name('add_pet_petshop');

//petshop vet
Route::get('/petshop/vets','VetController@vet_petshop_list');
Route::post('/petshop/vet/add','VetController@add_vet_petshop')->name('add_vet_petshop');

//petshop orderproduct
Route::get('/petshop/order/product','ProductController@show_petshop_order_product');
Route::post('/petshop/order/product/approve','ProductController@approve_order_product')->name('approve_order_product');
Route::post('/petshop/order/product/reject','ProductController@reject_order_product')->name('reject_order_product');

//petshop ordercare
Route::get('/petshop/order/care','CareController@show_petshop_order_care');
Route::post('/petshop/order/care/approve','CareController@approve_order_care')->name('approve_order_care');
Route::post('/petshop/order/care/reject','CareController@reject_order_care')->name('reject_order_care');

//petshop orderpet
Route::get('/petshop/order/pet','PetController@show_petshop_order_pet');
Route::post('/petshop/order/pet/approve','PetController@approve_order_pet')->name('approve_order_pet');
Route::post('/petshop/order/pet/reject','PetController@reject_order_pet')->name('reject_order_pet');

//petshop ordervet
Route::get('/petshop/order/vet','VetController@show_petshop_order_vet');
Route::post('/petshop/order/vet/approve','VetController@approve_order_vet')->name('approve_order_vet');
Route::post('/petshop/order/vet/reject','VetController@reject_order_vet')->name('reject_order_vet');

//customer
Route::get('/customer/login','CustomerController@show_login');
Route::get('/customer/register','CustomerController@show_register');
Route::post('/register_customer','CustomerController@create')->name('create_customer');
Route::post('/login_customer','CustomerController@login')->name('login_customer');
Route::get('/logout_customer','CustomerController@logout')->name('logout_customer');
Route::get('/customer/profile','CustomerController@show_profile');

//customer product
Route::get('/products','ProductController@product_list');

//customer care
Route::get('/cares','CareController@care_list');

//customer pet
Route::get('/pets','PetController@pet_list');

//customer vet
Route::get('/vets','VetController@vet_list');

//customer cart
Route::get('/customer/cart','CartController@customer_cart');
Route::post('/cart/add','CartController@add_to_cart')->name('add_to_cart');
Route::post('/cart/delete','CartController@remove_from_cart')->name('remove_from_cart');
Route::get('/cart/order','CartController@order_all')->name('order_all');

//customer orderproduct
Route::get('/customer/order/product','ProductController@show_customer_order_product');
Route::post('/customer/order/product/purchased','ProductController@purchased_order_product')->name('purchased_order_product');

//customer ordercare
Route::get('/customer/order/care','CareController@show_customer_order_care');
Route::post('/customer/order/ordercare','CareController@order_care')->name('order_care');
Route::post('/customer/order/care/purchased','CareController@purchased_order_care')->name('purchased_order_care');

//customer orderpet
Route::get('/customer/order/pet','PetController@show_customer_order_pet');
Route::post('/customer/order/orderpet','PetController@order_pet')->name('order_pet');
Route::post('/customer/order/pet/purchased','PetController@purchased_order_pet')->name('purchased_order_pet');

//customer ordervet
Route::get('/customer/order/vet','VetController@show_customer_order_vet');
Route::post('/customer/order/ordervet','VetController@order_vet')->name('order_vet');
Route::post('/customer/order/vet/purchased','VetController@purchased_order_vet')->name('purchased_order_vet');


Route::group(['middleware'=>'customer'], function(){

});

Route::group(['middleware'=>'petshop'], function(){
    
});