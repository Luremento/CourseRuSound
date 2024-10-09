<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Track, Albom, Like};
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
{
    public function index($id) {
        $like = null;
        $liked = Like::where('track_id', $id)->where('user_id', Auth::user()->id)->first();
        if ($liked) {
            $like = $liked;
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
    // public function New_Albom(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required|string',
    //         'cover' => 'required|image|mimes:jpg,png,jpeg,webp|max:8192'
    //     ]);

    //     $coverFile = $request->file('cover');
    //     $timestamp = time();
    //     $coverPath = $coverFile->storeAs('covers', $timestamp. '.'. $coverFile->getClientOriginalExtension(), 'public');

    //     $data = [
    //         'user_id' => Auth::user()->id,
    //         'name' => $request->name,
    //         'cover_file' => $coverPath
    //     ];
    //     Albom::create($data);
    //     return redirect()->back();
    // }
}
