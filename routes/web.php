<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use Illuminate\Support\Collection;


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

Route::any('/', function (Request $request) {
    $url = $request->input('do');
    return view('home',['url' => $url]);
});
Route::any('/requests/', function (Request $request) {
    $url = $request->input('do');
    return view('requests',['url' => $url]);
});

Route::post('/', [PostController::class, 'ajaxValidationStore'])->name('ajax.validation.store');
