<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Albom, Like, Track};
use Auth;

class AlbomController extends Controller
{
    public function index() {
        $alboms = Albom::where('user_id', Auth::id())->get();
        return view('ShowAlboms', [
            'alboms' => $alboms
        ]);
    }

    public function New_Albom(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'cover' => 'required|image|mimes:jpg,png,jpeg,webp|max:8192'
        ]);

        $coverFile = $request->file('cover');
        $timestamp = time();
        $coverPath = $coverFile->storeAs('covers', $timestamp. '.'. $coverFile->getClientOriginalExtension(), 'public');

        $data = [
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'cover_file' => $coverPath
        ];
        Albom::create($data);
        return redirect()->back();
    }

    public function delete_albom($albom_id)
    {
        Albom::where('id', $albom_id)->delete();
        return view('home', ['tracks' => Track::where('user_id', Auth::user()->id)->get(), 'alboms'=>Albom::with(['user'])->where('user_id', Auth::user()->id)->get(), 'user' => $user = Auth::user()]);
    }

    public function show_albom($id)
    {
        $newTrack = Like::with('track')->where('user_id', Auth::user()->id)->get();
        $albom = Albom::with('user')->where('id', $id)->first();

        // Проверяем, является ли $track_ids строкой и преобразуем её в массив
        if (is_string($albom->music)) {
            $track_ids = json_decode($albom->music, true); // Предполагаем, что $track_ids хранится как JSON
        } else {
            $track_ids = $albom->music; // Если это уже массив или коллекция, просто используем его
        }

        if (!empty($track_ids)){
            $tracks = Track::whereIn('id', $track_ids)->get();
        } else {
            $tracks = collect(); // Используем пустую коллекцию, если треков нет
        }

        return view('showAlbom', ['albom' => $albom, 'newTrack' => $newTrack, 'tracks' => $tracks]);
    }

    public function new_track_in_albom(Request $request)
    {
        $trackId = $request->track_id;
        $albomId = $request->albom_id;

        // Найти альбом по ID
        $albom = Albom::findOrFail($albomId);

        // Получить текущий JSON-массив из поля music
        $music = $albom->music ? json_decode($albom->music, true) : [];

        // Добавить новый трек в массив
        $music[] = $trackId;

        // Обновить поле music в базе данных
        $albom->music = json_encode($music);
        $albom->save();

        return redirect(route('index'));
    }

}
