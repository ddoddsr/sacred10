<?php

use Illuminate\Support\Facades\Route;
use App\Http\External\FormsiteController;
use App\Http\Controllers\Pdf;


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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
    // revise readme when changing
    Route::get('/storeforms',[FormsiteController::class, 'storeForms']);

    Route::get('/formmeta',[FormsiteController::class, 'getFormMeta']);

    Route::get('/pdf',[Pdf::class, 'test']);

// });