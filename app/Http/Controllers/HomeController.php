<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Track, Like, Albom,
    User, View, Comment};
use Auth;

class HomeController extends Controller
{

    /**
     * Отображение главной страницы
     *
     */
    public function index()
    {
        $new_tracks = Track::with(['user', 'likes'])->latest('created_at')->take(8)->get();
        $liked = null;
        $myPlaylists = null;
        if (Auth::check()) {
            $liked = Like::with(['user', 'track'])->where('user_id', Auth::user()->id)->take(5)->get();
            $myPlaylists = Albom::where('user_id', Auth::id())->get();
        }
        $alboms = Albom::with('user')->latest('created_at')->take(6)->get();
        return view('index', ['liked' => $liked, 'new_tracks' => $new_tracks, 'alboms' => $alboms, 'myPlaylists' => $myPlaylists]);
    }

    public function profile($user_id = null)
    {
        if ($user_id == null) {
            $user_id = Auth::id();
        }

        $tracks = Track::where('user_id', $user_id)->get();
        $alboms = Albom::with(['user'])->where('user_id', $user_id)->get();
        $user = User::where('id', $user_id)->first();

        // Получаем популярные треки
        $popular_track_ids = View::select('track_id')
            ->where('user_id', $user_id)
            ->groupBy('track_id')
            ->orderByRaw('COUNT(*) DESC')
            ->take(5)
            ->pluck('track_id')
            ->toArray();

        $popular_tracks = Track::whereIn('id', $popular_track_ids)->get();

        // Проверка на пустоту коллекций
        $tracks = $tracks->isEmpty() ? null : $tracks;
        $popular_tracks = $popular_tracks->isEmpty() ? null : $popular_tracks;

        return view('profile', [
            'tracks' => $tracks,
            'alboms' => $alboms,
            'user' => $user,
            'popular_tracks' => $popular_tracks
        ]);
    }


    public function search(Request $request)
    {
        $word = $request->word;

        $tracks = Track::where('name', 'like', "%{$word}%")->orderBy('id')->get();
        $alboms = Albom::where('name', 'like', "%{$word}%")->orderBy('id')->get();

        return view('index', [
            'tracks' => $tracks,
            'alboms' => $alboms,
        ]);
    }

    public function show_track($id)
    {
        $track = Track::with(['comment', 'user'])->where('id', $id)->first();
        $like = Like::where('track_id', $id)->where('user_id', Auth::user()->id)->first();
        return view('showTrackPage', ['track' => $track, 'like' => $like]);
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

    public function delete_comment(Request $request)
    {
        Comment::where('id', $request->comment_id)->delete();
        return redirect()->back();
    }

    public function like($track_id)
    {
        $likes = Like::where('user_id', Auth::user()->id)->where('track_id', $track_id)->first();
        if ($likes) {
            Like::where('track_id', $track_id)->where('user_id', Auth::user()->id)->delete();
        } else {
            $like_info = ([
                'user_id' => Auth::user()->id,
                'track_id' => $track_id,
            ]);
            Like::create($like_info);
        }
        return redirect()->back();
    }

}
