<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
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

    public function delete_comment(Request $request) {
        
        Comment::where('id', $request->comment_id)->delete();
        return redirect()->back();
    }
}
