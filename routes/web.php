<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{MusicController, CommentController,
    LikeController, AlbomController, ProfileController};

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');

Route::get('/upload', function () {
    return view('UploadTrack');
})->middleware('auth')->name('track.upload');

Route::get('/profile/{user_id?}', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile')->middleware('auth');

Route::post('/new_music', [MusicController::class, 'New_Music'])->name('NewMusic')->middleware('auth');

Route::get('/track/{id}', [MusicController::class, 'index'])->name('ShawTrack');

Route::post('/like', [LikeController::class, 'store'])->name('like.add')->middleware('auth');

Route::post('/new_comment/{id}', [CommentController::class, 'new_comment'])->name('NewComment')->middleware('auth');

Route::get('/del_track/{track_id}', [App\Http\Controllers\TrackController::class, 'delete_track'])->name('deleteTrack')->middleware('auth');

Route::post('/new/albom', [MusicController::class, 'New_Albom'])->name('NewAlbom')->middleware('auth');

Route::post('/del_comment', [CommentController::class, 'delete_comment'])->name('DeleteComm')->middleware('auth');

Route::controller(App\Http\Controllers\ProfileController::class)->group(function () {
    Route::post('/new_avatar', 'update_avatar')->name('profile.update-photo');
    Route::patch('/profile/update', 'update')->name('profile.update');
    Route::delete('/profile/destroy','destroy')->name('profile.destroy');
});

# НЕ делал еще

Route::get('/alboms', [AlbomController::class, 'index'])->name('alboms')->middleware('auth');
Route::get('/albom/{id}', [TrackController::class, 'show_albom'])->name('ShawAlbom');
Route::post('/albom/new_track/{albom_id}', [App\Http\Controllers\TrackController::class, 'new_track_in_albom'])->name('NewTrackinAlbom')->middleware('auth');
Route::get('/del_albom/{albom_id}', [App\Http\Controllers\TrackController::class, 'delete_albom'])->name('deleteAlbom')->middleware('auth');


Route::post('/search', [HomeController::class, 'search'])->name('search');





require __DIR__.'/auth.php';
