<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TodoController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::get('/user', [AuthController::class, 'user']);
  Route::get('/me', [AuthController::class, 'me']);
  Route::group(['todos'], function () {
    Route::get('getAllTodos/', [TodoController::class, 'index']);
    Route::post('saveTodo/', [TodoController::class, 'store']);
    Route::get('getTodo/{todo}', [TodoController::class, 'show']);
    Route::put('updateTodo/{todo}', [TodoController::class, 'update']);
    Route::delete('delete/{todo}', [TodoController::class, 'destroy']);
  });
});
