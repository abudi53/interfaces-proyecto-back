<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("profile", "App\Http\Controllers\ProfileController");


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('register', [AuthController::class, 'register']);
    Route::middleware('valid.token')->get('/verify-token', function (Request $request) {
        return response()->json(['message' => 'Token is valid']);
    });
    
});

Route::post('libros', [BookController::class, 'store']);
Route::get('libros', [BookController::class, 'index']);
Route::get('libros/{id}', [BookController::class, 'show']);
Route::post('libros/{id}', [BookController::class, 'update']);
Route::delete('libros/{id}', [BookController::class, 'destroy']);

Route::post('redes', [SocialController::class, 'store']);
Route::get('redes', [SocialController::class, 'index']);
Route::get('redes/{id}', [SocialController::class, 'show']);
Route::post('redes/{id}', [SocialController::class, 'update']);