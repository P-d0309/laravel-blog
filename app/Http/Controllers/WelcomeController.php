<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        $posts = Post::where('status', 'publised')->with('Auther')->get();

        return view('welcome', compact('posts'));
    }

    public function show($id) {
        $post  = Post::where('status', 'publised')->findOrFail($id);
        return view('detail', compact('post'));
    }
}
