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

use App\Http\Controllers\NeoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('getneobydate', [NeoController::class, 'getneobydate']);
Route::post('collectdate', [NeoController::class, 'collectdate']);
Route::get('getapidata', [NeoController::class, 'getapidata']);
