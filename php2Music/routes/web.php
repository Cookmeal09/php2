<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MusicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
| 
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('musics', MusicController::class)
    ->parameters(['musics' => 'Id']);

Route::get('/upload_form', [AdminController::class, 'showUploadForm']);
Route::match(['get', 'post'], '/upload', [AdminController::class, 'upload'])
    ->name('upload.submit');
Route::get('/home', [AdminController::class, 'index']);
