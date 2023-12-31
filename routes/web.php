<?php

use App\Http\Controllers\ShortlinkController;
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

// Route for display index page
Route::get('/', function () {
    return view('index');
});

// Route for redirect visiters to original url
Route::get('/{shorturl}', [ShortlinkController::class, 'show']);
