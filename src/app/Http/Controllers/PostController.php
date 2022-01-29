<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('all_users_likes')->orderBy('created_at', 'desc')->paginate(10);

        return view('post/index', compact('posts'));
    }

    public function create()
    {
        return view('post/create');
    }

    public function store(PostRequest $request)
    {
        $image = $request->file('image');
        $path = $image->store('public/post_images');

        Post::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'image' => basename($path)
        ]);

        return redirect('/');
    }

    public function destroy(Request $request)
    {
        Post::find($request->post_id)->delete();

        return redirect('/');
    }
}
