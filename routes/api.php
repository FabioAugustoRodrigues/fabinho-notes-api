<?php

use App\Http\Controllers\API\NoteController;
use App\Http\Controllers\API\UserController;
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

## AUTH URLS ###
Route::post('/auth/login', [UserController::class, 'login']);
Route::post('/auth/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/auth/register', [UserController::class, 'store']);

### USERS URLS ###
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

Route::put('/users', [UserController::class, 'update'])->middleware('auth:sanctum');;
Route::delete('/users', [UserController::class, 'delete'])->middleware('auth:sanctum');;

Route::post('/users/notes', [NoteController::class, 'store'])->middleware('auth:sanctum');
Route::patch('/users/notes/{id}/title', [NoteController::class, 'updateTitleById'])->middleware('auth:sanctum');
Route::patch('/users/notes/{id}/content', [NoteController::class, 'updateContentById'])->middleware('auth:sanctum');
Route::delete('/users/notes/{id}', [NoteController::class, 'delete'])->middleware('auth:sanctum');

### NOTES URLS ###
Route::get('/notes', [NoteController::class, 'index']);
Route::get('/notes/{id}', [NoteController::class, 'show']);
Route::get('/notes/slug/{slug}', [NoteController::class, 'getBySlug']);
Route::get('/notes/title/{title}', [NoteController::class, 'listByTitle']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
