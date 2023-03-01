<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\PostsApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function(){
    //Todo lo que haya en este grupo se accedera escribiendo /api/v1/....
    Route::post('login',[AuthController::class, 'autenticate']);

    //Registro de usuario
    Route::post('register', [AuthController::class, 'register']);

    //Logout
    Route::group(['middleware'=> ['jwt.verify']], function(){
    
    //Todo lo que haya en este grupo requiere autnticación del usuario
    Route::post('logout',[AuthController::class, 'logout']);


    Route::post('get-user',[AuthController::class, 'getUser']);

    Route::get('post', [PostsApiController::class, 'index']);

    Route::get('post/{id}', [PostsApiController::class, 'show']);

    Route::post('post', [PostsApiController::class, 'store']);

    Route::put('post/{id}', [PostsApiController::class, 'update']);
    });
});