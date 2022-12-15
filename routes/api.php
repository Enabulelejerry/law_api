<?php

use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\HeadtypeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegistrarOpertationController;
use App\Http\Controllers\UpdateUserController;
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



Route::get('/get/stamp',[UpdateUserController::class,'GetStamp']);
Route::group(['middleware'=>['auth:api']],function(){
Route::post('/update/user',[UpdateUserController::class,'UpdateUser']);
Route::post('/upload/stamp',[UpdateUserController::class,'UploadStamp']);
Route::apiResource('file/upload',FileUploadController::class);
Route::post('/register',[RegisterController::class,'RegisterUser']);
Route::post('/upload/process',[ProcessController::class,'UploadProcess']);
Route::get('/get/process',[ProcessController::class,'GetProcess']);
Route::get('/single/process',[ProcessController::class,'PreviewProcess']);
Route::get('/lawyer/process',[ProcessController::class,'LawyerProcess']);
Route::get('/get/headtype',[HeadtypeController::class,'GetheadType']);
Route::post('/create/case',[RegistrarOpertationController::class,'CreateCase']);
Route::get('/get/case',[RegistrarOpertationController::class,'GetCase']);
Route::post('/assign/case',[RegistrarOpertationController::class,'AssignCase']);
Route::post('/login',[LoginController::class,'LoginUser']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
