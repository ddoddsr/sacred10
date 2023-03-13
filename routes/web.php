<?php

use Illuminate\Support\Facades\Route;
use App\Http\External\FormsiteController;



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

// Route::get('/formnames', function () {
//     $results = new Formsite();
//     $results->getUsers();
//     dd("DONE - Names");
// });

Route::get('/formnames',[FormsiteController::class, 'getUsers']);

Route::get('/formmeta',[FormsiteController::class, 'getFormMeta']);
