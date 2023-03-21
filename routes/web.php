<?php

use Illuminate\Support\Facades\Route;
use App\Http\External\FormsiteController;
use App\Http\Controllers\Pdf;
use App\Models\Comment;
use App\Models\Set;


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
    });
    Route::get('/sets', function (Set $set) {
        return view('sets/table', ['set' => $set]);
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
 });
