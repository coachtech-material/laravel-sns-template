<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $like = $request->only(['post_id']);
        $like['user_id'] = Auth::id();

        Like::create($like);

        return back()->with('message', 'いいねしました');
    }

    public function destroy(Request $request)
    {
        Like::find($request->like_id)->delete();

        return back()->with('message', 'いいねを取り消しました');
    }
}
