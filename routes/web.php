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

Route::get('test',[Controller::class,'test']);
//session route
Route::get('/session/{product_id}/{quantity}/{session_task}',[Controller::class,'session'])->name('session');

//public route
Route::get('/',[HomeController::class,'publicHome'])->name('publicHome');
Route::get('/term-and-conditions',[TCController::class,'publicTC'])->name('publicTC');
Route::get('/contact',[ContactController::class, 'publicContact'])->name('publicContact');
Route::get('/FAQ',[FAQController::class, 'publicFAQ'])->name('publicFAQ');

//show Product
Route::resource('categories',CategoryController::class);
Route::get('singleProduct/{productID}/{productName}',[ProductController::class,'singleProduct'])->name('singleProduct');

//comment
Route::post('comment/{product_id}',[ProductController::class,'postComment'])->name('postComment');

//cart
Route::get('cart',[CartController::class, 'cartIndex'])->name('cartIndex');

//checkout
Route::get('checkout',[CheckoutController::class, 'checkoutIndex'])->name('checkoutIndex');
Route::post('checkout',[CheckoutController::class, 'postCheckout'])->name('postCheckout');
//IDPay
Route::get('gateway/{Transaction_ID}',[CheckoutController::class,'sendForPay'])->name('sendForPay');
Route::post('callback',[CheckoutController::class,'callback'])->name('callback');

//login & register
Route::get('/login',[UserController::class, 'login'])->name('login');
Route::get('/register',[UserController::class, 'register'])->name('register');
Route::post('login',[UserController::class, 'postLogin'])->name('postLogin');
Route::post('/register',[UserController::class, 'postRegister'])->name('postRegister');
Route::get('logout',[UserController::class, 'logout'])->name('logout');
//admin route
//user
Route::get('admin/index',[AdminController::class, 'adminIndex'])->name('adminIndex');
Route::get('admin/visitUser',[AdminController::class, 'adminVisitUser'])->name('adminVisitUser');
Route::get('admin/addUser',[AdminController::class, 'adminAddUser'])->name('adminAddUser');
Route::get('admin/updateUser/{id}',[AdminController::class, 'adminUpdateUser'])->name('adminUpdateUser');
Route::post('admin/addUser',[AdminController::class, 'adminPostAddUser'])->name('adminPostAddUser');
Route::post('admin/updateUser/{id}',[AdminController::class, 'adminPostUpdateUser'])->name('adminPostUpdateUser');
//role & permission
Route::get('admin/visitPermission',[AdminController::class, 'adminVisitPermission'])->name('adminVisitPermission');
Route::get('admin/addPermission',[AdminController::class, 'adminAddPermission'])->name('adminAddPermission');
Route::get('admin/updatePermission/{id}',[AdminController::class, 'adminUpdatePermission'])->name('adminUpdatePermission');
Route::get('admin/visitRole',[AdminController::class, 'adminVisitRole'])->name('adminVisitRole');
Route::get('admin/addRole',[AdminController::class, 'adminAddRole'])->name('adminAddRole');
Route::get('admin/updateRole/{id}',[AdminController::class, 'adminUpdateRole'])->name('adminUpdateRole');
Route::post('admin/addPermission',[AdminController::class, 'adminPostAddPermission'])->name('adminPostAddPermission');
Route::post('admin/updatePermission/{id}',[AdminController::class, 'adminPostUpdatePermission'])->name('adminPostUpdatePermission');
Route::get('admin/deletePermission/{id}',[AdminController::class, 'adminDeletePermission'])->name('adminDeletePermission');
Route::post('admin/addRole',[AdminController::class, 'adminPostAddRole'])->name('adminPostAddRole');
Route::post('admin/updateRole/{id}',[AdminController::class, 'adminPostUpdateRole'])->name('adminPostUpdateRole');
Route::get('admin/deleteRole/{id}',[AdminController::class, 'adminDeleteRole'])->name('adminDeleteRole');
//category
Route::get('admin/visitCategory',[AdminController::class, 'adminVisitCategory'])->name('adminVisitCategory');
Route::get('admin/addCategory',[AdminController::class, 'adminAddCategory'])->name('adminAddCategory');
Route::get('admin/addParentCategory/{id}',[AdminController::class, 'adminAddParentCategory'])->name('adminAddParentCategory');
Route::get('admin/updateCategory/{id}',[AdminController::class, 'adminUpdateCategory'])->name('adminUpdateCategory');
Route::post('admin/addCategory',[AdminController::class, 'adminPostAddCategory'])->name('adminPostAddCategory');
Route::post('admin/addParentCategory/{id}',[AdminController::class, 'adminPostAddParentCategory'])->name('adminPostAddParentCategory');
Route::post('admin/updateCategory/{id}', [AdminController::class, 'adminPostUpdateCategory'])->name('adminPostUpdateCategory');
//tag
Route::get('admin/visitTag',[AdminController::class, 'adminVisitTag'])->name('adminVisitTag');
Route::get('admin/addTag',[AdminController::class, 'adminAddTag'])->name('adminAddTag');
Route::get('admin/updateTag/{id}',[AdminController::class, 'adminUpdateTag'])->name('adminUpdateTag');
Route::post('admin/addTag', [AdminController::class, 'adminPostAddTag'])->name('adminPostAddTag');
Route::post('admin/updateTag/{id}',[AdminController::class, 'adminPostUpdateTag'])->name('adminPostUpdateTag');
//discount
Route::get('admin/visitDiscount',[AdminController::class, 'adminVisitDiscount'])->name('adminVisitDiscount');
Route::get('admin/addDiscount',[AdminController::class, 'adminAddDiscount'])->name('adminAddDiscount');
Route::get('admin/updateDiscount/{id}',[AdminController::class, 'adminUpdateDiscount'])->name('adminUpdateDiscount');
Route::post('admin/addDiscount', [AdminController::class, 'AdminPostAddDiscount'])->name('adminPostAddDiscount');
Route::post('admin/updateDiscount/{id}', [AdminController::class, 'adminPostUpdateDiscount'])->name('adminPostUpdateDiscount');
//product
Route::get('admin/visitProduct', [AdminController::class, 'adminVisitProduct'])->name('adminVisitProduct');
Route::get('admin/addProduct', [AdminController::class, 'adminAddProduct'])->name('adminAddProduct');
Route::get('admin/updateProduct/{id}', [AdminController::class, 'adminUpdateProduct'])->name('adminUpdateProduct');
Route::post('admin/addProduct',[AdminController::class, 'adminPostAddProduct'])->name('adminPostAddProduct');
Route::post('admin/updateProduct/{id}',[AdminController::class, 'adminPostUpdateProduct'])->name('adminPostUpdateProduct');
Route::get('admin/deleteProductImage/{id}',[AdminController::class, 'adminDeleteProductImage'])->name('adminDeleteProductImage');
//comment
Route::get('admin/visitComment', [AdminController::class, 'adminVisitComment'])->name('adminVisitComment');
Route::get('admin/updateComment/{id}', [AdminController::class, 'adminUpdateComment'])->name('adminUpdateComment');
Route::post('admin/updateComment/{id}',[AdminController::class, 'adminPostUpdateComment'])->name('adminPostUpdateComment');
//region & city & zone
Route::get('admin/visitRegion',[AdminController::class, 'adminVisitRegion'])->name('adminVisitRegion');
Route::get('admin/addRegion',[AdminController::class, 'adminAddRegion'])->name('adminAddRegion');
Route::get('admin/updateRegion/{id}',[AdminController::class, 'adminUpdateRegion'])->name('adminUpdateRegion');
Route::get('admin/visitCity',[AdminController::class, 'adminVisitCity'])->name('adminVisitCity');
Route::get('admin/addCity/{id}',[AdminController::class, 'adminAddCity'])->name('adminAddCity');
Route::get('admin/updateCity/{id}',[AdminController::class, 'adminUpdateCity'])->name('adminUpdateCity');
Route::get('admin/visitZone',[AdminController::class, 'adminVisitZone'])->name('adminVisitZone');
Route::get('admin/addZone/{id}',[AdminController::class, 'adminAddZone'])->name('adminAddZone');
Route::get('admin/updateZone/{id}',[AdminController::class, 'adminUpdateZone'])->name('adminUpdateZone');
Route::post('admin/addRegion',[AdminController::class, 'adminPostAddRegion'])->name('adminPostAddRegion');
Route::post('admin/updateRegion/{id}',[AdminController::class, 'adminPostupdateRegion'])->name('adminPostupdateRegion');
Route::post('admin/addCity/{id}',[AdminController::class,'adminPostAddCity'])->name('adminPostAddCity');
Route::post('admin/updateCity/{id}',[AdminController::class,'adminPostUpdateCity'])->name('adminPostUpdateCity');
Route::post('admin/addZone/{id}',[AdminController::class,'adminPostAddZone'])->name('adminPostAddZone');
Route::post('admin/updateZone/{id}',[AdminController::class, 'adminPostUpdateZone'])->name('adminPostUpdateZone');
//address
Route::get('admin/visitAddress',[AdminController::class, 'adminVisitAddress'])->name('adminVisitAddress');
Route::get('admin/deleteAddress/{id}',[AdminController::class,'adminDeleteAddress'])->name('adminDeleteAddress');
//order
Route::get('admin/visitOrder',[AdminController::class, 'adminVisitOrder'])->name('adminVisitOrder');
//transaction
Route::get('admin/visitTransaction', [AdminController::class, 'adminVisitTransaction'])->name('adminVisitTransaction');
//contact
Route::get('admin/visitContact', [AdminController::class, 'adminVisitContact'])->name('adminVisitContact');
