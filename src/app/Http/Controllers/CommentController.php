<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $reservation = $request->only(['post_id', 'comment']);
        $reservation['user_id'] = Auth::id();
        Comment::create($reservation);

        return back()->with('message', 'コメントを作成しました');
    }

    public function destroy(Request $request)
    {
        Comment::find($request->comment_id)->delete();

        return back()->with('message', 'コメントを削除しました');
    }
}
