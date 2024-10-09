<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{MusicController, CommentController,
    LikeController};

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/profile/{user_id?}', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile')->middleware('auth');

Route::get('/upload', function () {
    return view('UploadTrack');
})->middleware('auth')->name('track.upload');

Route::post('/new_music', [MusicController::class, 'New_Music'])->name('NewMusic')->middleware('auth');

Route::post('/new/albom', [MusicController::class, 'New_Albom'])->name('NewAlbom')->middleware('auth');

Route::get('/track/{id}', [MusicController::class, 'index'])->name('ShawTrack');

Route::get('/albom/{id}', [TrackController::class, 'show_albom'])->name('ShawAlbom');

Route::post('/like', [LikeController::class, 'store'])->name('like.add')->middleware('auth');

Route::post('/new_comment/{id}', [CommentController::class, 'new_comment'])->name('NewComment')->middleware('auth');

Route::post('/albom/new_track/{albom_id}', [App\Http\Controllers\TrackController::class, 'new_track_in_albom'])->name('NewTrackinAlbom')->middleware('auth');

Route::get('/del_comment', [CommentController::class, 'delete_comment'])->name('DeleteComm')->middleware('auth');

Route::get('/del_track/{track_id}', [App\Http\Controllers\TrackController::class, 'delete_track'])->name('deleteTrack')->middleware('auth');

Route::get('/del_albom/{albom_id}', [App\Http\Controllers\TrackController::class, 'delete_albom'])->name('deleteAlbom')->middleware('auth');

Route::put('/new_avatar', [HomeController::class, 'avatar'])->name('NewAvatar')->middleware(['auth']);

Route::post('/search', [HomeController::class, 'search'])->name('search');


require __DIR__.'/auth.php'; 
