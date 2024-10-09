<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Auth;

class LikeController extends Controller
{
    /**
     * Добавляем трек в избранное либо удаляем, если он уже есть
     *
     */
    public function store(Request $request) {
        $request->validate([
            'track_id' => 'required|integer|min:1',
        ]);

        $existingLike = Like::where('user_id', Auth::id())->where('track_id', $request->track_id)->first();

        if ($existingLike) {
            $existingLike->delete();
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'track_id' => $request->track_id,
            ]);
        }

        return redirect()->back();
    }
}
