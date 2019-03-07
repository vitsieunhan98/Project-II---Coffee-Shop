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

Route::get('trang-chu', [
    'as'=>'trang-chu',
    'uses'=>'ProductController@getMainPage'
]);

Route::get('loai-san-pham/{id}', [
   'as'=>'loai-san-pham',
   'uses'=>'ProductController@getType'
]);

Route::get('chi-tiet/{id_product}', [
   'as'=>'chi-tiet',
    'uses'=>'ProductController@getDetailsProduct'
]);

Route::get('dang-nhap', [
   'as'=>'an-dang-nhap',
    'uses'=>'GuestController@getLogin'
]);

Route::post('dang-nhap', [
    'as'=>'dang-nhap',
    'uses'=>'GuestController@postLogin'
]);

Route::get('dang-ky', [
    'as'=>'an-dang-ky',
    'uses'=>'GuestController@getRegister'
]);

Route::post('dang-ky', [
    'as'=>'dang-ky',
    'uses'=>'GuestController@postRegister'
]);

Route::get('dang-xuat', [
   'as'=>'dang-xuat',
    'uses'=>'UserController@logout'
]);

Route::post('rate-product/{id_product}', [
   'as'=>'rate-product',
   'uses'=>'UserController@rateProduct'
]);

Route::get('view-profile', [
   'as'=>'view-profile',
   'uses'=>'UserController@viewProfile'
]);

Route::post('post-cmt/{id_product}', [
   'as'=>'post-cmt',
   'uses'=>'UserController@postComment'
]);

Route::post('post-rep-cmt/{id_comment}', [
    'as'=>'post-rep-cmt',
    'uses'=>'UserController@postRepComment'
]);

Route::post('edit-profile', [
   'as'=>'edit-profile',
   'uses'=>'UserController@editProfile'
]);

Route::get('an-dat-hang', [
   'as'=>'an-dat-hang',
   'uses'=>'UserController@getOrder'
]);

Route::post('dat-hang', [
   'as'=>'dat-hang',
   'uses'=>'UserController@postOrder'
]);

Route::get('xem-product', [
   'as'=>'xem-product',
   'uses'=>'AdminController@getProductView'
]);

Route::post('them-product', [
   'as'=>'them-product',
   'uses'=>'AdminController@addProduct'
]);

Route::post('edit-product/{id_product}', [
    'as'=>'edit-product',
    'uses'=>'AdminController@editProduct'
]);

Route::post('delete-product/{id_product}', [
   'as'=>'delete-product',
   'uses'=>'AdminController@deleteProduct'
]);

Route::get('xem-don-hang', [
   'as'=>'xem-don-hang',
   'uses'=>'AdminControlelr@getBillView'
]);

Route::post('duyet-don-hang/{id_bill}', [
   'as'=>'duyet-don-hang',
   'uses'=>'AdminController@confirmOrder'
]);

Route::get('xem-nguoi-dung', [
   'as'=>'xem-nguoi-dung',
   'uses'=>'AdminController@getUserView'
]);

Route::get('xem-don-hang-user/{id_user}', [
    'as'=>'xem-don-hang-user',
    'uses'=>'AdminController@getUserBill'
]);

Route::post('nang-quyen/{id_user}', [
    'as'=>'nang-quyen',
    'uses'=>'AdminController@upgradeRole'
]);

Route::post('lock/{id_user}', [
   'as'=>'lock',
   'uses'=>'AdminController@lockUser'
]);

Route::post('unlock/{id_user}', [
    'as'=>'unlock',
    'uses'=>'AdminController@unlockUser'
]);

Route::get('add-to-cart/{id}', [
   'as'=>'add-to-cart',
   'uses'=>'CartController@getAddToCart'
]);

Route::get('del-item-cart/{id}', [
   'as'=>'del-item-cart',
   'uses'=>'CartController@getDelItemCart'
]);