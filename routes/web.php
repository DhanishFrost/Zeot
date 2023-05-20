<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProductController;

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

        Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
        Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
        Route::get('edit-user/{id}', [AdminUserController::class, 'editUser']);
        Route::post('/admin/update-user', [AdminUserController::class, 'updateUser'])->name('update.user');

        // Veiw propduct (admin only)
        Route::get('/admin/adminproduct', [ProductController::class, 'adminProduct'])->name('product.adminProduct');
        // Create a product (admin only)
        Route::get('/admin/adminproduct/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/admin/adminproduct', [ProductController::class, 'store'])->name('product.store');
        // Edit a product (admin only)
        Route::get('/admin/adminproduct/edit/{product}', [ProductController::class, 'editProduct'])->name('product.edit');
        Route::post('/admin/adminproduct-update', [ProductController::class, 'updateProduct'])->name('product.update');
        // Delete a product (admin only)
        Route::delete('/admin/adminproduct/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });
    // View products (users)
    Route::get('/users/product', [ProductController::class, 'userProduct'])->name('product.userProduct');
});
