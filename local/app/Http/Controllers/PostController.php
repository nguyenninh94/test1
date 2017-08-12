<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostController extends Controller
{
    public function index()
    {
       $post = Post::orderBy('id', 'DESC')->paginate(5);
       return response()->json($post);
    }

    public function store(Request $request)
    {
    	Post::create([
           'user_id' => Auth::id(),
           'content' => $request->content
    	]);

    	return response()->json(['success']);
    }
}
