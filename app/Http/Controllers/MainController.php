<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function root() {
        return redirect()
            ->route('home');
    }
    
    public function home() 
    {
        $posts = Post::with('user:id,username,profile_pic')
            ->withCount('comments')
            ->latest()
            ->paginate(10);

        return view('home', ['posts' => $posts]);
    }
}
