<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Auth;

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


Route::get('/', function () {
    return view('home');
});

Auth::routes();

Auth::routes([/*'register'=>false,*/ 'reset'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Route::group(['middleware' => 'auth'], function(){
    //Cuando el usuario inicie sesión irá a esta página
    Route::get('/', [PostController::class, 'index'])->name('home'); 
});
*/ /** CUIDADO**/
//Route::resource('producto', PostController::class)->middleware('auth'); 

//Route::resource('post', PostController::class)->middleware('auth'); 

Route::resource('producto', ProductoController::class);

Route::get('/producto',[ProductoController::class,'index']);

Route::resource('post', PostController::class);

Route::get('/post',[PostController::class,'index']);


    
