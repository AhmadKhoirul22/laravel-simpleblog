<?php

use App\Http\Controllers\Auth_Controller;
use App\Http\Controllers\Content_Controller;
use App\Http\Controllers\Dashboard_Controller;
use App\Http\Controllers\Frontend_Controller;
use App\Http\Controllers\Kategori_Controller;
use App\Http\Controllers\User_Controller;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// dashboard
Route::get('/dashboard',[Dashboard_Controller::class,'index'])->name('dashboard');
// Auth
Route::get('/login',[Auth_Controller::class,'index'])->name('login');
Route::post('/auth',[Auth_Controller::class,'auth'])->name('auth');
Route::post('/logout',[Auth_Controller::class,'logout'])->name('logout');
// user
Route::middleware('auth')->group(function () {
    // user
    Route::get('/user',[User_Controller::class,'index'])->name('user');
    Route::post('/user/store',[User_Controller::class,'store'])->name('user.store');
    Route::delete('/user/destroy/{id}',[User_Controller::class,'destroy'])->name('user.destroy');
    Route::put('/user/update/{id}',[User_Controller::class,'update'])->name('user.update');

    // kategori
    Route::get('/kategori',[Kategori_Controller::class,'index'])->name('kategori');
    Route::post('/kategori/store',[Kategori_Controller::class,'store'])->name('kategori.store');
    Route::delete('/kategori/destroy/{id}',[Kategori_Controller::class,'destroy'])->name('kategori.destroy');
    Route::put('/kategori/update/{id}',[Kategori_Controller::class,'update'])->name('kategori.update');

    // content
    Route::get('/content',[Content_Controller::class,'index'])->name('content');
    Route::post('/content/store',[Content_Controller::class,'store'])->name('content.store');
    Route::delete('/content/destroy/{id}',[Content_Controller::class,'destroy'])->name('content.destroy');
    Route::put('/content/update/{id}',[Content_Controller::class,'update'])->name('content.update');
});


// route frondend
// Route::get('/frontend',[Frontend_Controller::class,'index'])->name('frontend');
Route::get('/',[Content_Controller::class,'konten'])->name('konten');
Route::get('/konten/detail/{id}',[Content_Controller::class,'detail_konten'])->name('detail_konten');
