<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductEditController;
use App\Http\Livewire\EditProduct;
use App\Http\Livewire\ProductSearchAndFilter;
use App\Http\Livewire\AdminSidebar;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
});



Route::get('redirects', [HomeController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/admin/admindashboard', [HomeController::class, 'index'])->name('index');

        // View users (admin only)
        Route::get('/admin/users', [AdminUserController::class, 'adminUser'])->name('admin.users.index');
        Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
        Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
        Route::get('edit-user/{id}', [AdminUserController::class, 'editUser']);
        Route::post('/admin/update-user', [AdminUserController::class, 'updateUser'])->name('update.user');
        //Route::get('/products', ProductSearchAndFilter::class)->name('product.index');


        // Veiw propduct (admin only)
        Route::get('/admin/adminproduct', [ProductController::class, 'adminProduct'])->name('product.adminProduct');
        // Create a product (admin only)
        Route::get('/admin/adminproduct/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/admin/adminproduct', [ProductController::class, 'store'])->name('product.store');
        // Edit a product (admin only)
        //Route::get('/admin/adminproduct/edit/{product}', [ProductController::class, 'editProductPage'])->name('editProduct');
        //Route::post('/admin/adminproduct-update', [ProductController::class, 'updateProduct'])->name('product.update');
        Route::get('/admin/adminproduct/edit/{product}', [ProductController::class, 'editProductPage'])->name('editProductPage');
        Route::put('/admin/adminproduct/update', [EditProduct::class, 'updateProduct'])->name('updateProduct');   
        // Delete a product (admin only)
        Route::delete('/admin/adminproduct/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
        // View Orders (admin only)
        Route::get('/admin/adminorder', function () { return view('admin.adminOrder'); })->name('admin.adminOrder');
    });

    // Profile
    Route::get('/user/profile', function () { return view('users.userProfile'); })->name('users.userProfile');
    // Address Book
    Route::get('/user/addressbook', function () { return view('users.addressBook'); })->name('users.addressBook');
    // View products (users)
    Route::get('/user/product', [ProductController::class, 'userProduct'])->name('product.userProduct');
    // View product detail (users)
    Route::get('/user/product/{id}', [ProductController::class, 'show'])->name('product.show')->middleware('track.views');
    // View Cart (users)
    Route::get('/user/cart', function () { return view('users.cart'); })->name('users.cart');
    // View Checkout (users)
    Route::get('/user/checkout', function () { return view('users.checkout'); })->name('users.checkout');
    // View Order Success (users)
    Route::get('/user/ordersuccess', function () { return view('users.orderSuccess'); })->name('users.orderSuccess');
    // View Order History (users)
    Route::get('/user/orderhistory', function () { return view('users.orderHistory'); })->name('users.orderHistory');
    
});
