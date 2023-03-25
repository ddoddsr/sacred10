<?php

use App\Models\Set;
use App\Models\Comment;
use App\Http\Controllers\Pdf;
use App\Http\Livewire\Utility;
use App\Http\Livewire\SetsTable;
use App\Http\Livewire\StaffTable;
use App\Http\Livewire\UsersTable;
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
// });  //TODO add below to auth group
    // TODO revise readme when changing
    Route::post('/storeforms',[FormsiteController::class, 'storeForms'])->name('storeforms');

    Route::get('/formmeta',[FormsiteController::class, 'getFormMeta']);

    Route::get('/pdf',[Pdf::class, 'test']);

    Route::get('/sets/{set}/edit', function (Set $set) {
        return view('sets/edit', ['set' => $set]);
    });

    Route::patch('/sets/{set}', function (Set $set) {
        $set->update(
            request()->validate(['dayOfWeek' => 'required|string'])
        );

        return redirect("/sets/{$set->id}/edit");
    });

    Route::get('/comments/{comment}/edit', function (Comment $comment) {
        return view('comments.edit', ['comment' => $comment]);
    });

    Route::patch('/comments/{comment}', function (Comment $comment) {
        $comment->update(
            request()->validate(['body' => 'required|string'])
        );

        return redirect("/comments/{$comment->id}/edit");
    });

    Route::delete('/comments/{comment}', function (Comment $comment) {
        // authorize the delete

        $comment->delete();

        return redirect('/');
    });

    Route::get('/users', [ UsersTable::class, 'render'])->name('users.table');

    Route::get('/staff', [ StaffTable::class, 'render'])->name('staff.table');

    Route::get('/sets', [ SetsTable::class, 'render'])->name('sets.table');

    Route::get('/utils', [ Utility::class,'render'])->name('remote.utils');

    Route::post('/importNewestStaffSchedules', [ Utility::class,'importNewestStaffSchedules'])->name('importNewestStaffSchedules');

    Route::post('/truncateSchedules', [ Utility::class,'truncateSchedule'])->name('truncateSchedules');

    Route::post('/importStaffSchedules', [ Utility::class,'importStaffSchedules'])->name('importStaffSchedules');
    
    Route::post('/generateStaffSetdPdf', [ Utility::class,'generateStaffSetdPdf'])->name('generateStaffSetdPdf');


    //  
 });
