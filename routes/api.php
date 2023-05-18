<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\EntrieController;
use App\Http\Controllers\PadletController;
use App\Http\Controllers\RatingController;
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
Route::get('padlets/username/{id}', [PadletController::class,'getUserName']);


Route::post('/padlets', [PadletController::class, 'save']);
Route::put('/padlets/{id}', [PadletController::class, 'update']);
Route::delete('padlets/{isbn}', [PadletController::class, 'delete']);

Route::get('entries', [EntrieController::class,'index']);
Route::get('padlets/{padlet_id}/entries', [EntrieController::class,'findByPadletID']);

Route::post('/padlets/{padlet_id}/entries', [EntrieController::class, 'save']);
Route::put('/padlets/{padlet_id}/entries/{id}', [EntrieController::class, 'update']);
Route::delete('/padlets/{padlet_id}/entries/{id}', [EntrieController::class, 'delete']);

Route::get('padlets/{padlet_id}/entries/{id}/ratings', [RatingController::class,'findByEntrieID']);
Route::get('padlets/{padlet_id}/entries/{id}/comments', [CommentController::class,'findByEntrieID']);
Route::post('padlets/{padlet_id}/entries/{id}/ratings', [RatingController::class,'save']);
Route::post('padlets/{padlet_id}/entries/{id}/comments', [CommentController::class,'save']);








