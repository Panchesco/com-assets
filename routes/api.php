<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
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
Route::get('/role', function() {
    $data = [
        'message' => "This is the Roles landing page."
    ];
    return response()->json($data, 200);
});

// Roles
Route::post('/role/create',[RoleController::class, 'createRole']);
Route::post('/role/update',[RoleController::class, 'createRole']);


Route::middleware('jwt.verify')->group(function() {
    Route::get('/dashboard', function() {
        return response()->json(['message' => 'Welcome to dashboard'], 200);
    });
});