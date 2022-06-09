<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\WriterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
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


//

Route::get('/', [ClientController::class, 'home'])->name('home');
// Route::get('/about-us','ClientController@about')->name('about');
// Route::get('/contact-us','ClientController@contact')->name('contact');
// Route::get('/product-details/{id}','ClientController@productDetails')->name('product.productDetails');
// Route::get('/product-list/{id}','ClientController@productList')->name('product.productList');
// Route::post('/product/search', 'ClientController@search')->name('product.search');
// Route::get('/category/{slug}','ClientController@category')->name('category.category');
// Route::get('/publisher/{slug}','ClientController@publisher')->name('publisher.publisher');
// Route::get('/writer/{slug}','ClientController@writer')->name('writer.writer');




Auth::routes();

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Auth::routes();

Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin')->middleware('auth');

Route::group(['prefix'=>'/admin', 'middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::resource('product', ProductController::class)->name('*', 'data');
	Route::resource('category', CategoryController::class)->name('*','category');

	Route::resource('publisher', PublisherController::class)->name('*','publisher');
	Route::resource('writer', WriterController::class)->name('*','writer');
	Route::resource('user', UserController::class)->name('*','user');

	Route::get('/income',[OrderController::class, 'incomeChart'])->name('book.order.income');
	
	Route::get('/finance' , function(){
		return view('admin.finance.index');
	})->name('finance');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	// Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

// Route::group(['middleware' => 'auth'], function () {
// 	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
// 	Route::get('product', ['as' => 'product.createa', 'uses' => 'App\Http\Controllers\ProductController@edit']);
// 	// Route::put('product', ['as' => 'product.update', 'uses' => 'App\Http\Controllers\ProductController@update']);
// 	// Route::put('product/password', ['as' => 'product.password', 'uses' => 'App\Http\Controllers\ProductController@password']);
// });

