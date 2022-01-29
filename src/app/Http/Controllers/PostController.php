<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['all_users_likes', 'users_comments'])->orderBy('created_at', 'desc')->paginate(10);

        return view('post/index', compact('posts'));
    }

    public function create()
    {
        return view('post/create');
    }

    public function store(PostRequest $request)
    {
    }

    public function destroy(Request $request)
    {
    }
}
