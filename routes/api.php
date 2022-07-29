<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AssetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function() {
    $data = [
        'message' => "Welcome to our API"
    ];
    return response()->json($data, 200);
});

// Users
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user', [AuthController::class, 'getUser']);

// Roles
Route::post('/role/create',[RoleController::class, 'create']);
Route::post('/role/update',[RoleController::class, 'update']);

// Assets
Route::get('/asset',[AssetController::class, 'index']);
Route::get('/asset/create',[AssetController::class, 'create']);
Route::get('/asset/{id}',[AssetController::class, 'show']);
Route::get('/asset/edit/{id}',[AssetController::class, 'edit']);
Route::post('/asset/update',[AssetController::class, 'store']);
Route::post('/asset/delete',[AssetController::class, 'destroy']);

// Assigments




Route::middleware('jwt.verify')->group(function() {
    Route::get('/dashboard', function() {
        return response()->json(['message' => 'Welcome to dashboard'], 200);
    });
});