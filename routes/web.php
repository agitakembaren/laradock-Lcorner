<?php

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
    return view('welcome');
});

Route::get('/rajaongkir', function () {
    return view('rajaongkir');
});

Route::get('/cekresi', function () {
    return view('cekresi');
});

Route::get('/ekspedisi', function () {
    return view('ekspedisi');
});

Route::get('/download', function () {
    return view('download');
});

Route::get('/about', function () {
    return view('about');
});