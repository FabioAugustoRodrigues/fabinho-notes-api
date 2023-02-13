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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

### USERS URLS ###
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'delete']);

### NOTES URLS ###
Route::get('/notes', [NoteController::class, 'index']);
Route::get('/notes/{id}', [NoteController::class, 'show']);
Route::get('/notes/slug/{slug}', [NoteController::class, 'getBySlug']);
Route::get('/notes/title/{title}', [NoteController::class, 'listByTitle']);
Route::post('/notes', [NoteController::class, 'store']);
Route::patch('/notes/{id}/title', [NoteController::class, 'updateTitleById']);
Route::patch('/notes/{id}/content', [NoteController::class, 'updateContentById']);
Route::delete('/notes/{id}', [NoteController::class, 'delete']);