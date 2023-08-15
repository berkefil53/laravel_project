<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ProductController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [UserController::class, 'checkLogin']);


        // Kullanıcı Rotaları
    Route::group(['middleware' => 'auth:sanctum'],function() {

        Route::controller(UserController::class)->group(function () {
            Route::post('addUser', 'addUser');
            Route::get('/listUser', 'listUser');
            Route::delete('deleteSelectedUsers', 'deleteSelectedUsers');
            Route::put('editUser/{id}', 'editUser');
            Route::put('/edit-selected-user/{id}', 'editUser');
            Route::put('/update-selected-user/{id}', 'updateSelectedUser');
            Route::delete('deleteUser/{id}', 'deleteUser');
            Route::post('logout', 'logout');

        });
        // Kategori Rotaları
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/categoryList', 'categoryList');
            Route::put('editCategory/{id}', 'editCategory');
            Route::put('/edit-selected-category/{id}', 'editCategory');
            Route::put('/update-selected-category/{id}', 'updateSelectedCategory');
            Route::post('/categoryAdd', 'categoryAdd');
            Route::delete('/deleteCategory/{id}', 'deleteCategory');
        });
        //Ürün Rotaları
        Route::controller(ProductController::class)->group(function () {
            Route::post('/productAdd', 'productAdd');
            Route::get('/productList', 'productList');
            Route::put('editProduct/{id}', 'editProduct');
            Route::put('/edit-selected-product/{id}', 'editProduct');
            Route::put('/update-selected-product/{id}', 'updateSelectedProduct');
            Route::delete('deleteProduct/{id}', 'deleteProduct');
        });
    });
