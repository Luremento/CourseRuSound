<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Albom, Like, Track, View};
use Illuminate\Support\Facades\Validator;
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
        // $newTrack = Like::with('track')->where('user_id', Auth::user()->id)->get();
        $albom = Albom::with('user')->where('id', $id)->first();

        if(Auth::check()) {
            $views = View::where('user_id', Auth::user()->id)->where('albom_id', $id)->first();
            if (!$views) {
                View::create([
                    'user_id' => Auth::user()->id,
                    'albom_id' => $id
                ]);
            }
        }

        if (is_string($albom->music)) {
            $track_ids = json_decode($albom->music, true);
        } else {
            $track_ids = $albom->music;
        }

        if (!empty($track_ids)){
            $tracks = Track::whereIn('id', $track_ids)->get();
        } else {
            $tracks = collect();
        }

        return view('showAlbom', ['albom' => $albom, 'tracks' => $tracks]);
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

    public function delete_track(Request $request) {
        $validator = Validator::make($request->all(), [
            'track_id' => 'required|integer',
            'albom_id' => 'required|integer',
        ]);

        $trackId = $request->input('track_id');
        $albomId = $request->input('albom_id');
        $albom = Albom::findOrFail($albomId);
        $tracks = json_decode($albom->music, true);
        if (($key = array_search($trackId, $tracks)) !== false) {
            unset($tracks[$key]);
            $albom->music = json_encode(array_values($tracks));
            $albom->save();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function albom_delete($albom_id) {
        Albom::where('id', $albom_id)->delete();

        return redirect()->route('index');
    }
}
