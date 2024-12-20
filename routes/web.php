<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{MusicController, CommentController,
    LikeController, AlbomController, ProfileController, HomeController,
    AdminController};
use App\Http\Middleware\IsAdmin;

Route::get('/upload', function () {
    return view('UploadTrack');
})->middleware('auth')->name('track.upload');

Route::controller(App\Http\Controllers\ProfileController::class)->group(function () {
    Route::post('/new_avatar', 'update_avatar')->name('profile.update-photo');
    Route::patch('/profile/update', 'update')->name('profile.update');
    Route::delete('/profile/destroy','destroy')->name('profile.destroy');
    Route::get('/profile/edit', 'edit')->name('profile.edit')->middleware('auth');
});

Route::controller(App\Http\Controllers\HomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/search', 'search')->name('search');
    Route::get('/profile/{user_id?}', 'profile')->name('profile')->middleware('auth');
    Route::post('/new_comment/{id}', 'new_comment')->name('NewComment');
    Route::post('/commtent/delete/', 'delete_comment')->name('DeleteComm');
});

Route::controller(App\Http\Controllers\MusicController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::post('/new_track', 'New_Music')->name('NewMusic');
        Route::delete('/del_track', 'delete_track')->name('deleteTrack');
    });
    Route::get('/track/{id}', 'index')->name('ShawTrack');
});


Route::get('/stats', [AdminController::class, 'index'])->name('stats')->middleware(IsAdmin::class);
Route::post('/like', [LikeController::class, 'store'])->name('like.add')->middleware('auth');

Route::middleware(IsAdmin::class)->group(function () {
    Route::get('/stats/exel', [AdminController::class, 'exel'])->name('exel');
});

Route::controller(App\Http\Controllers\AlbomController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::delete('/albom/track/delete', 'delete_track')->name('albom.track.delete');
        Route::get('/playlist', 'index')->name('alboms');
        Route::post('/playlist/new_track', 'new_track_in_albom')->name('addTrackToPlaylist');
        Route::get('/playlist/delete/{albom_id}', 'albom_delete')->name('deleteAlbom');
        Route::post('/new/playlist', 'New_Albom')->name('NewAlbom');
    });
    Route::get('/playlist/{id}', 'show_albom')->name('ShawAlbom');
});



require __DIR__.'/auth.php';
