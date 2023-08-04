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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/generate_shortlink', [ShortlinkController::class, 'store']);
Route::get('/get_links_data', [ShortlinkController::class, 'index']);
Route::post('/nbvisit', [ShortlinkController::class, 'count_visit']);