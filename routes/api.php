<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\userController;
use App\Http\Controllers\apiController;

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

Route::post('/login', [userController::class, "Login"]);
Route::post('/register', [userController::class, "Registration"]);

// sanctum routes
Route::group(['middleware' => ["auth:sanctum"]], function () {

    Route::get('/countries', [apiController::class, "All"]);
    Route::get('/summary', [apiController::class, "Sum"]);

    Route::post('/logout', [userController::class, "Logout"]);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});