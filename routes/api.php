<?php

use App\Http\Controllers\ShortlinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route for Generate short link 
Route::post('/generate_shortlink', [ShortlinkController::class, 'store']);

// Route for Get links Data
Route::get('/get_links_data', [ShortlinkController::class, 'index']);

// Route for Count click links
Route::post('/nbvisit', [ShortlinkController::class, 'count_visit']);

// Route for Get Most three links
Route::get('/get_most_links', [ShortlinkController::class, 'get_most_three_links']);
