<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Track, Albom, Like, View};
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
{
    public function index($id) {
        $like = null;
        if (Auth::check()) {
            $liked = Like::where('track_id', $id)->where('user_id', Auth::user()->id)->first();
            if ($liked) {
                $like = $liked;
            }
            $views = View::where('user_id', Auth::user()->id)->where('track_id', $id)->first();
            if (!$views) {
                View::create([
                    'user_id' => Auth::user()->id,
                    'track_id' => $id
                ]);
            }
        }
        return view('ShowTrack', [
            'track' => Track::with(['comment', 'user'])->where('id', $id)->first(),
            'like' =>$like
        ]);
    }

    public function new_music(Request $request)
    {
        $validatedData = $request->validate([
            'track' => 'required|mimetypes:audio/flac,audio/wav,audio/alac,audio/aiff,audio/mpeg|max:8192',
            'track_name' => 'required|string',
            'genre_track' => 'required|string',
            'cover' => 'required|image|mimes:jpg,png,jpeg,webp|max:8192'
        ]);

        // Получаем трек и обложку
        $musicFile = $request->file('track');
        $coverFile = $request->file('cover');
        // Получаем имя и жанр трэка
        $trackName = $request->input('track_name');
        $genre = $request->input('genre_track');
        // Получение unix времени
        $timestamp = time();

        // Скачиваем и переименовываем в $timestamp трек
        $musicPath = $musicFile->storeAs('public/music', $timestamp. '.'. $musicFile->getClientOriginalExtension(), 'public');

        // Скачиваем и переименовываем в $timestamp обложку
        $coverPath = $coverFile->storeAs('public/covers', $timestamp. '.'. $coverFile->getClientOriginalExtension(), 'public');

        $track = [
            'user_id' => Auth::user()->id,
            'name' => $trackName,
            'genre' => $genre,
            'music_file' => $musicPath,
            'cover_file' => $coverPath
        ];
        Track::create($track);

        $track = Track::where('cover_file', $coverPath)->first();

        return redirect()->route('ShawTrack', ['id' => $track]);
    }

    public function delete_track(Request $request)
    {
        $validatedData = $request->validate([
            'track_id' => 'required|integer|min:1',
        ]);

        Track::where('id', $request->track_id)->delete();
        return redirect(route('index'));
    }

    public function new_comment($id, Request $request)
    {
        $validatedData = $request->validate([
            'comment' => 'required|string',
        ]);

        $theme = Comment::create([
            'user_id' => Auth::user()->id,
            'track_id' => $id,
            'comment' => $request->comment
        ]);
        $theme->save();
        return redirect()->back();
    }
}
