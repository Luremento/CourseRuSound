<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlbomController extends Controller
{
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
        $track_ids = $albom->music;
        if (!empty($track_ids)){
            $tracks = Track::whereIn('id', $track_ids)->get();
        } else {
            $tracks = null;
        }
        return view('showAlbomPage', ['albom' => $albom, 'newTrack' => $newTrack, 'tracks' => $tracks]);
    }
    public function new_track_in_albom($albom_id, Request $request)
    {
        $album = Albom::find($albom_id);

        $track_id = $request->input('track_id');

        if (in_array($track_id, $album->music ?? [])) {
            // Track ID already exists in the album's music array
            return redirect()->back()->with('error', 'Track already exists in the album');
        }

        $music = $album->music?: [];
        $music[] = $track_id;
        $album->setAttribute('music', $music);
        $album->save();
        return redirect()->back()->with('success', 'Track added to the album');
    }

}
