<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

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

Route::get('/', [DocumentController::class, 'index']);
Route::post('/upload', [DocumentController::class, 'upload']);
Route::get('/search', [DocumentController::class, 'search']);

// Route::get('/uploads/pdf', [DocumentController::class, 'displayPdf']);
