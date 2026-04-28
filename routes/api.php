<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;


Route::get('/students', [StudentController::class, 'index']);
Route::post('/students', [App\Http\Controllers\StudentController::class, 'store']);
Route::delete('/students/{id}', [App\Http\Controllers\StudentController::class, 'destroy']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Add your new route here:
Route::post('/register', [StudentController::class, 'store']);


// Public Routes (Anyone can access)
// Route::post('/register', [AuthController::class, 'register']);
Route::post('/student-register', [StudentController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Only logged-in users with a token can access)
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});



// Protected Routes (Only accessible with a Token)
Route::middleware('auth:sanctum')->group(function () {
    
    // View all students
    Route::get('/students', [StudentController::class, 'index']);
    
    // Logout (Optional, but good to have)
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    
});

// Add this at the bottom of routes/api.php
Route::get('/login', function(){
    return response()->json(['message' => 'Unauthorized - Please login to get a token'], 401);
})->name('login');