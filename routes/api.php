<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EntrieController;
use App\Http\Controllers\PadletController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
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

Route::get('padlets', [PadletController::class,'index']);
Route::get('padlets/{id}', [PadletController::class,'findByID']);
Route::get('padlets/checkid/{id}', [PadletController::class,'checkID']);
Route::get('padlets/search/{searchTerm}', [PadletController::class,'findBySearchTerm']);
Route::get('users', [UserController::class,'getAllUsers']);
Route::get('users/{id}', [UserController::class,'getSingleUser']);

//Route::get('padlets/username/{id}', [PadletController::class,'getUserName']);
//Route::get('padlets/userimage/{id}', [PadletController::class,'getUserImage']);


Route::group(['middleware' => ['api','auth.jwt', 'auth.admin']], function(){

    Route::post('/padlets', [PadletController::class, 'save']);
    Route::put('/padlets/{id}', [PadletController::class, 'update']);
    Route::delete('padlets/{isbn}', [PadletController::class, 'delete']);

    Route::post('/padlets/{padlet_id}/entries', [EntrieController::class, 'save']);
    Route::put('/padlets/{padlet_id}/entries/{id}', [EntrieController::class, 'update']);
    Route::delete('/padlets/{padlet_id}/entries/{id}', [EntrieController::class, 'delete']);

    Route::post('padlets/{padlet_id}/entries/{id}/ratings', [RatingController::class,'save']);
    Route::post('padlets/{padlet_id}/entries/{id}/comments', [CommentController::class,'save']);

    Route::post('auth/logout', [AuthController::class,'logout']);

});

Route::get('entries', [EntrieController::class,'index']);
Route::get('padlets/{padlet_id}/entries', [EntrieController::class,'findByPadletID']);
Route::get('entries/{entrie_id}', [EntrieController::class,'getEntryByID']);

Route::get('padlets/{padlet_id}/entries/{id}/ratings', [RatingController::class,'findByEntrieID']);
Route::get('entries/{id}/ratings/{user_id}', [RatingController::class,'hasAlreadyRated']);
Route::get('padlets/{padlet_id}/entries/{id}/comments', [CommentController::class,'findByEntrieID']);


Route::post('auth/login', [AuthController::class,'login']);










