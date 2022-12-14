<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/",function(){
       return "share insta api";
});

Route::group(['prefix' => 'v1'], function () {

    Route::get("/customer", "CustomerController@index");

    Route::post("/customer/{code}", "CustomerController@store");

    Route::post("/orders","OrderController@store");
});
