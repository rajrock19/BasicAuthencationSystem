<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
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


Route::get('/',[AuthController::class,'homePage']);
Route::get('register',[AuthController::class,'registerPage']);
Route::get('login',[AuthController::class,'loginUser']);

// Route::middleware(['auth'])->group( function(){
Route::get('dashboard', [AuthController::class, 'dashboard']);

Route::get('delete/user/{id}',[AuthController::class,'delete'])->name('user.delete');
Route::get('edit/user/{id}',[AuthController::class,'edit'])->name('user.edit');
// });
Route::get('show',[AuthController::class,'showUser']);
Route::get('show/trash',[AuthController::class,'trash']);
Route::post('register',[AuthController::class,'registerUser'])->name('register');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom'); 

Route::post('update/user/{id}',[AuthController::class,'update'])->name('user.update');

Route::get('get-all-session',function(){
    $session=session()->all();
    p($session);
});
Route::get('set-session',function(Request $request){
    $request->session()->put('name','Raj yadav');
    $request->session()->put('id','1');
    return redirect('get-all-session');
});
Route::get('destroy-session',function(Request $request){
    session()->forget(['name','id']);
   
    return redirect('get-all-session');
});