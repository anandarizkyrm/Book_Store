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
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
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

Route::get('user/login',[ClientController::class, 'login'])->name('login.form');
Route::post('user/login',[ClientController::class, 'loginSubmit'])->name('login.submit');
Route::get('user/logout', [ClientController::class, 'logout'])->name('logout.user');

// Route::get('admin/login',[AdminController::class, 'login'])->name('login');
// Route::get('admin/logout',[AdminController::class, 'logout'])->name('logout');

Route::get('login/{provider}/', [RedirectController::class, 'redirect'])->name('login.redirect');
Route::get('login/{provider}/callback/', [RedirectController::class, 'callback'])->name('login.callback');

Route::post('password-reset', [ClientController::class , 'showResetForm'])->name('password.reset'); 
Route::get('user/logout',[ClientController::class, 'logout'])->name('user.logout');

Route::get('user/register',[ClientController::class, 'register'])->name('register.form');
Route::post('user/register',[ClientController::class, 'registerSubmit'])->name('register.submit');
//


// Product Review
Route::resource('/review',ReviewController::class);
Route::post('product/{slug}/review',[ReviewController::class, 'store'])->name('review.store');
	
Route::get('product-detail/{slug}',[ClientController::class , 'productDetail'])->name('product-detail');
// Route::get('/about-us','ClientController@about')->name('about');
// Route::get('/contact-us','ClientController@contact')->name('contact');
Route::get('/product-details/{id}',[ClientController::class, 'productDetails'])->name('product.productDetails');
Route::get('/product-list/{id}',[ClientController::class, 'productList'])->name('product.productList');
// Route::post('/product/search', [ClientController::class, 'search')->name('product.search');
// Route::get('/category/{slug}',[ClientController::class, 'category')->name('category.category');
// Route::get('/publisher/{slug}',[ClientController::class, 'publisher')->name('publisher.publisher');
// Route::get('/writer/{slug}',[ClientController::class, 'writer')->name('writer.writer');
Route::get('/product-grids',[ClientController::class, 'productGrids'])->name('product-grids');
Route::get('/product-lists',[ClientController::class, 'productLists'])->name('product-lists');
Route::match(['get','post'],'/filter',[ClientController::class , 'productFilter'])->name('shop.filter');
Route::get('/product-cat/{slug}',[ClientController::class, 'productCat'])->name('product-cat');
Route::post('/product/search',[ClientController::class, 'productSearch'])->name('product.search');

//cart 
Route::get('/add-to-cart/{slug}',[CartController::class ,'addToCart'])->name('add-to-cart')->middleware('user');
Route::post('/add-to-cart',[CartController::class, 'singleAddToCart'])->name('single-add-to-cart')->middleware('user');
Route::get('cart-delete/{id}',[CartController::class, 'cartDelete'])->name('cart-delete');
Route::post('cart-update',[CartController::class, 'cartUpdate'])->name('cart.update');
Route::get('/checkout',function(){
	return  view('client.pages.checkout');
})->name('checkout')->middleware('user');

Route::post('cart/order',[OrderController::class, 'store'])->name('cart.order');
Route::get('order/pdf/{id}',[OrderController::class, 'pdf'])->name('order.pdf');
// Route::get('/income',[OrderController::class, 'incomeChart'])->name('product.order.income');
Route::get('/cart',function(){
    return view("client.cart.index");
})->name('cart');



Route::get('/',[ClientController::class, 'home'])->name('home');
//about us 
Route::get('/about-us',function(){
	return view("client.about_us");
})->name('about-us');

Auth::routes();
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Auth::routes();

// Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin')->middleware('auth');

Route::group(['prefix'=>'/admin', 'middleware' => ['admin']], function () {


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


// User section start
Route::group(['prefix'=>'/user','middleware'=>['user']],function(){
    Route::get('/',[HomeController::class, 'index'])->name('user');
     // Profile
     Route::get('/profile',[HomeController::class, 'profile'])->name('user-profile');
     Route::post('/profile/{id}',[HomeController::class, 'profileUpdate'])->name('user-profile-update');
    //  Order
    Route::get('/order',[HomeController::class, 'orderIndex'])->name('user.order.index');
    Route::get('/order/show/{id}',[HomeController::class, 'orderShow'])->name('user.order.show');
    Route::delete('/order/delete/{id}',[HomeController::class, 'userOrderDelete'])->name('user.order.delete');
    // Product Review
    Route::get('/user-review',[HomeController::class, 'productReviewIndex'])->name('user.productreview.index');
    Route::delete('/user-review/delete/{id}',[HomeController::class, 'productReviewDelete'])->name('user.productreview.delete');
    Route::get('/user-review/edit/{id}',[HomeController::class, 'productReviewEdit'])->name('user.productreview.edit');
    Route::patch('/user-review/update/{id}',[HomeController::class, 'productReviewUpdate'])->name('user.productreview.update');
    
    // Post comment
    Route::get('user-post/comment',[HomeController::class, 'userComment'])->name('user.post-comment.index');
    Route::delete('user-post/comment/delete/{id}',[HomeController::class, 'userCommentDelete'])->name('user.post-comment.delete');
    Route::get('user-post/comment/edit/{id}',[HomeController::class, 'userCommentEdit'])->name('user.post-comment.edit');
    Route::patch('user-post/comment/udpate/{id}',[HomeController::class, 'userCommentUpdate'])->name('user.post-comment.update');
    
    // Password Change
    Route::get('change-password', [HomeController::class, 'changePassword'])->name('user.change.password.form');
    Route::post('change-password', [HomeController::class, 'changPasswordStore'])->name('change.password');

});


// Route::group(['middleware' => 'auth'], function () {
// 	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
// 	Route::get('product', ['as' => 'product.createa', 'uses' => 'App\Http\Controllers\ProductController@edit']);
// 	// Route::put('product', ['as' => 'product.update', 'uses' => 'App\Http\Controllers\ProductController@update']);
// 	// Route::put('product/password', ['as' => 'product.password', 'uses' => 'App\Http\Controllers\ProductController@password']);
// });

