<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TCController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;

//session route
Route::get('/session/{product_id}/{quantity}/{session_task}',[Controller::class,'session'])->name('session');

//public route
Route::get('/',[HomeController::class,'publicHome'])->name('publicHome');
Route::get('/term-and-conditions',[TCController::class,'publicTC'])->name('publicTC');
Route::get('/contact',[ContactController::class, 'publicContact'])->name('publicContact');
Route::post('/contact',[ContactController::class,'postContact'])->name('postContact');
Route::get('/FAQ',[FAQController::class, 'publicFAQ'])->name('publicFAQ');

//show Product
Route::resource('categories',CategoryController::class);
Route::get('singleProduct/{productID}/{productName}',[ProductController::class,'singleProduct'])->name('singleProduct');

//comment
Route::post('comment/{product_id}',[ProductController::class,'postComment'])->name('postComment')->middleware('auth');

//cart
Route::get('cart',[CartController::class, 'cartIndex'])->name('cartIndex');

//checkout
Route::get('checkout',[CheckoutController::class, 'checkoutIndex'])->name('checkoutIndex')->middleware('auth');
Route::post('checkout',[CheckoutController::class, 'postCheckout'])->name('postCheckout')->middleware('auth');
//IDPay
Route::get('gateway/{Transaction_ID}',[CheckoutController::class,'sendForPay'])->name('sendForPay')->middleware('auth');
Route::post('callback',[CheckoutController::class,'callback'])->name('callback');

//login & register
Route::get('/login',[UserController::class, 'login'])->name('login')->middleware('after.login');
Route::get('/register',[UserController::class, 'register'])->name('register')->middleware('after.login');
Route::post('login',[UserController::class, 'postLogin'])->name('postLogin')->middleware('after.login');
Route::post('/register',[UserController::class, 'postRegister'])->name('postRegister')->middleware('after.login');
Route::get('logout',[UserController::class, 'logout'])->name('logout')->middleware('auth');
//admin route
//user
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function (){
    Route::get('index',[AdminController::class, 'adminIndex'])->name('adminIndex');
    Route::get('visitUser',[AdminController::class, 'adminVisitUser'])->name('adminVisitUser');
    Route::get('addUser',[AdminController::class, 'adminAddUser'])->name('adminAddUser');
    Route::get('updateUser/{id}',[AdminController::class, 'adminUpdateUser'])->name('adminUpdateUser');
    Route::post('addUser',[AdminController::class, 'adminPostAddUser'])->name('adminPostAddUser');
    Route::post('updateUser/{id}',[AdminController::class, 'adminPostUpdateUser'])->name('adminPostUpdateUser');
//role & permission
    Route::get('visitPermission',[AdminController::class, 'adminVisitPermission'])->name('adminVisitPermission');
    Route::get('addPermission',[AdminController::class, 'adminAddPermission'])->name('adminAddPermission');
    Route::get('updatePermission/{id}',[AdminController::class, 'adminUpdatePermission'])->name('adminUpdatePermission');
    Route::get('visitRole',[AdminController::class, 'adminVisitRole'])->name('adminVisitRole');
    Route::get('addRole',[AdminController::class, 'adminAddRole'])->name('adminAddRole');
    Route::get('updateRole/{id}',[AdminController::class, 'adminUpdateRole'])->name('adminUpdateRole');
    Route::post('addPermission',[AdminController::class, 'adminPostAddPermission'])->name('adminPostAddPermission');
    Route::post('updatePermission/{id}',[AdminController::class, 'adminPostUpdatePermission'])->name('adminPostUpdatePermission');
    Route::get('deletePermission/{id}',[AdminController::class, 'adminDeletePermission'])->name('adminDeletePermission');
    Route::post('addRole',[AdminController::class, 'adminPostAddRole'])->name('adminPostAddRole');
    Route::post('updateRole/{id}',[AdminController::class, 'adminPostUpdateRole'])->name('adminPostUpdateRole');
    Route::get('deleteRole/{id}',[AdminController::class, 'adminDeleteRole'])->name('adminDeleteRole');
//category
    Route::get('visitCategory',[AdminController::class, 'adminVisitCategory'])->name('adminVisitCategory');
    Route::get('addCategory',[AdminController::class, 'adminAddCategory'])->name('adminAddCategory');
    Route::get('addParentCategory/{id}',[AdminController::class, 'adminAddParentCategory'])->name('adminAddParentCategory');
    Route::get('updateCategory/{id}',[AdminController::class, 'adminUpdateCategory'])->name('adminUpdateCategory');
    Route::post('addCategory',[AdminController::class, 'adminPostAddCategory'])->name('adminPostAddCategory');
    Route::post('addParentCategory/{id}',[AdminController::class, 'adminPostAddParentCategory'])->name('adminPostAddParentCategory');
    Route::post('updateCategory/{id}', [AdminController::class, 'adminPostUpdateCategory'])->name('adminPostUpdateCategory');
//tag
    Route::get('visitTag',[AdminController::class, 'adminVisitTag'])->name('adminVisitTag');
    Route::get('addTag',[AdminController::class, 'adminAddTag'])->name('adminAddTag');
    Route::get('updateTag/{id}',[AdminController::class, 'adminUpdateTag'])->name('adminUpdateTag');
    Route::post('addTag', [AdminController::class, 'adminPostAddTag'])->name('adminPostAddTag');
    Route::post('updateTag/{id}',[AdminController::class, 'adminPostUpdateTag'])->name('adminPostUpdateTag');
//discount
    Route::get('visitDiscount',[AdminController::class, 'adminVisitDiscount'])->name('adminVisitDiscount');
    Route::get('addDiscount',[AdminController::class, 'adminAddDiscount'])->name('adminAddDiscount');
    Route::get('updateDiscount/{id}',[AdminController::class, 'adminUpdateDiscount'])->name('adminUpdateDiscount');
    Route::post('addDiscount', [AdminController::class, 'AdminPostAddDiscount'])->name('adminPostAddDiscount');
    Route::post('updateDiscount/{id}', [AdminController::class, 'adminPostUpdateDiscount'])->name('adminPostUpdateDiscount');
//product
    Route::get('visitProduct', [AdminController::class, 'adminVisitProduct'])->name('adminVisitProduct');
    Route::get('addProduct', [AdminController::class, 'adminAddProduct'])->name('adminAddProduct');
    Route::get('updateProduct/{id}', [AdminController::class, 'adminUpdateProduct'])->name('adminUpdateProduct');
    Route::post('addProduct',[AdminController::class, 'adminPostAddProduct'])->name('adminPostAddProduct');
    Route::post('updateProduct/{id}',[AdminController::class, 'adminPostUpdateProduct'])->name('adminPostUpdateProduct');
    Route::get('deleteProductImage/{id}',[AdminController::class, 'adminDeleteProductImage'])->name('adminDeleteProductImage');
//comment
    Route::get('visitComment', [AdminController::class, 'adminVisitComment'])->name('adminVisitComment');
    Route::get('updateComment/{id}', [AdminController::class, 'adminUpdateComment'])->name('adminUpdateComment');
    Route::post('updateComment/{id}',[AdminController::class, 'adminPostUpdateComment'])->name('adminPostUpdateComment');
//region & city & zone
    Route::get('visitRegion',[AdminController::class, 'adminVisitRegion'])->name('adminVisitRegion');
    Route::get('addRegion',[AdminController::class, 'adminAddRegion'])->name('adminAddRegion');
    Route::get('updateRegion/{id}',[AdminController::class, 'adminUpdateRegion'])->name('adminUpdateRegion');
    Route::get('visitCity',[AdminController::class, 'adminVisitCity'])->name('adminVisitCity');
    Route::get('addCity/{id}',[AdminController::class, 'adminAddCity'])->name('adminAddCity');
    Route::get('updateCity/{id}',[AdminController::class, 'adminUpdateCity'])->name('adminUpdateCity');
    Route::get('visitZone',[AdminController::class, 'adminVisitZone'])->name('adminVisitZone');
    Route::get('addZone/{id}',[AdminController::class, 'adminAddZone'])->name('adminAddZone');
    Route::get('updateZone/{id}',[AdminController::class, 'adminUpdateZone'])->name('adminUpdateZone');
    Route::post('addRegion',[AdminController::class, 'adminPostAddRegion'])->name('adminPostAddRegion');
    Route::post('updateRegion/{id}',[AdminController::class, 'adminPostupdateRegion'])->name('adminPostupdateRegion');
    Route::post('addCity/{id}',[AdminController::class,'adminPostAddCity'])->name('adminPostAddCity');
    Route::post('updateCity/{id}',[AdminController::class,'adminPostUpdateCity'])->name('adminPostUpdateCity');
    Route::post('addZone/{id}',[AdminController::class,'adminPostAddZone'])->name('adminPostAddZone');
    Route::post('updateZone/{id}',[AdminController::class, 'adminPostUpdateZone'])->name('adminPostUpdateZone');
//address
    Route::get('visitAddress',[AdminController::class, 'adminVisitAddress'])->name('adminVisitAddress');
    Route::get('deleteAddress/{id}',[AdminController::class,'adminDeleteAddress'])->name('adminDeleteAddress');
//order
    Route::get('visitOrder',[AdminController::class, 'adminVisitOrder'])->name('adminVisitOrder');
//transaction
    Route::get('visitTransaction', [AdminController::class, 'adminVisitTransaction'])->name('adminVisitTransaction');
//contact
    Route::get('visitContact', [AdminController::class, 'adminVisitContact'])->name('adminVisitContact');
});

