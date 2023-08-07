<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KullanicilarController;
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

/*
Route::get('/', function () {
    return view('/login');
});
Route::post('/login', [KullanicilarController::class,'checkLogin']);
Route::get('/main', function(){return view('/main');});
*/
Route::get('/login', function () { return view('login'); })->name('login');
Route::get('/', function () { return view('main'); });
Route::post('login',[KullanicilarController::class,'checkLogin'])->name('loginPost');
Route::group(['middleware' => 'auth'], function () {
Route::get('main',function (){return view('main');})->name('main');
Route::get('logout',[KullanicilarController::class,'logout'])->name('logout');
Route::post('addUser', function () {return view('addUser');})->name('addUserPost');
Route::post('main',[KullanicilarController::class,'addUser'])->name('saveAddUser');
Route::get('addUser', function () {return view('addUser');})->name('addUser');
Route::post('listUser',[KullanicilarController::class,'listUser'])->name('listUserPost');
Route::get('listUser',[KullanicilarController::class,'listUser'])->name('listUserN');
Route::post('deleteSelectedUsers', [KullanicilarController::class, 'deleteSelectedUsers'])->name('deleteSelectedUsers');
Route::get('editUser/{id}',[KullanicilarController::class,'editUser'])->name('editUser');
Route::get('/edit-selected-user/{id}', [KullanicilarController::class,'editUser'])->name('edit-selected-user');
Route::post('/update-selected-user/{id}', [KullanicilarController::class,'updateSelectedUser'])->name('update-selected-user');
Route::get('deleteUser/{id}', [KullanicilarController::class, 'deleteUser'])->name('deleteUser');

});
