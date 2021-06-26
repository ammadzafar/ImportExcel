<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('single_record');
});


Route::group(['prefix'=>'import_excel'],function (){
    Route::get('/index',[\App\Http\Controllers\ImportExcelController::class,'index'])->name('index');
    Route::post('/store/record',[\App\Http\Controllers\ImportExcelController::class,'import'])->name('upload.file');
    Route::get('/view/details/{id}',[\App\Http\Controllers\ImportExcelController::class,'detail'])->name('file.details');
});


