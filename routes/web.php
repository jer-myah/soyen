<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function () {
    return view('test');
});

Route::match(['get', 'post'],'/admin', 'AdminController@login');



Route::group(['middleware' => ['auth']], function ()
{
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/settings', 'AdminController@settings');
    Route::get('/admin/checkpassword', 'AdminController@checkPassword');
    Route::match(['get', 'post'], '/admin/update-password', 'AdminController@updatePassword');

    // Routes to Category Conttroller
    Route::match(['get', 'post'], '/admin/add-category', 'CategoryController@addCategory');
    Route::get('/admin/checkcategory', 'CategoryController@check_category');
    Route::get('/admin/view-categories', 'CategoryController@viewCategories');
    Route::match(['get', 'post'], '/admin/edit-category/{id}', 'CategoryController@editCategory');
    Route::match(['get', 'post'], '/admin/delete-category/{id}', 'CategoryController@deleteCategory');

    // Routes to Product Controller
    Route::match(['get', 'post'], '/admin/add-product', 'ProductController@addProduct');
    Route::get('/admin/view-products', 'ProductController@viewProducts');
    Route::match(['get', 'post'], '/admin/edit-product/{id}', 'ProductController@editProduct');
    Route::match(['get', 'post'], '/admin/delete-product/{id}', 'ProductController@deleteProduct');

    // Routes for Product Attribute
    Route::match(['get', 'post'], '/admin/add-attributes/{id}', 'ProductController@addAttributes');
    Route::get('/admin/delete-attribute/{id}', 'ProductController@deleteAttribute');
});

Route::get('/logout', 'AdminController@logout');

