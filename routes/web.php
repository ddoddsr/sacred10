<?php

use App\Models\Set;
use App\Models\Staff;
use App\Models\Comment;
use App\Http\Controllers\Pdf;
use App\Http\Livewire\SetTable;
use App\Http\Livewire\UserTable;
use App\Http\Livewire\StaffTable;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
    Route::get('/storeforms',[FormsiteController::class, 'storeForms']);

    Route::get('/formmeta',[FormsiteController::class, 'getFormMeta']);

    Route::get('/pdf',[Pdf::class, 'test']);

    Route::get('/sets/{set}/edit', function (Set $set) {
        return view('sets/edit', ['set' => $set]);
    })->name('set.edit');

    // Route::get('/set/edit', SetTable::class);
    Route::get('/sets', SetTable::class)->name('sets');

    Route::patch('/sets/{set}', function (Set $set) {
        $set->update(
            request()->validate(
                [
                    'worshipLeader' => 'string',
                    'prayerLeader' => 'string',
                    'sectionLeader' => 'string',
                ]
            )
        );

        return redirect("/sets/{$set->id}/edit");
    });

// STAFF
    Route::get('/staff', StaffTable::class)->name('staff');
    // Route::get('/staff/edit', StaffTable::class);
    Route::get('/staff/{staff}/edit', function (Staff $staff) {
        return view('staff/edit', ['staff' => $staff]);
    })->name('staff.edit');
    Route::patch('/staff/{staff}', function (Staff $staff) {
        $staff->update(
            request()->validate(
                [
                    'firstName' => 'string',
                    'lastName' => 'string',
                    'email' => 'string',
                ]
            )
        );

        return redirect("/staff/{$staff->id}/edit");
    });

//COMMENTS
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
 });

 Route::get('/users',[UserController::class, 'index'])
 ->name('users');
 Route::get('/users/{user}/edit',[UserTable::class, 'edit'])
 ->name('users.edit');
