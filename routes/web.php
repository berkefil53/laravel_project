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
Route::get('/', function () {
    return view('login');})->name('login');
Route::post('login',[KullanicilarController::class,'checkLogin'])->name('loginPost');
Route::get('main',function (){return view('main');})->name('main')->middleware('auth');
Route::get('logout',[KullanicilarController::class,'logout'])->name('logout');
