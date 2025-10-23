<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function postMake() 
    {
        if(!Auth::check()) {
            return redirect()->route('login')->with('');
        }

        return view('posts.post-make');
    }

    public function postCreate(Request $request) 
    {
        $data = $request->validate([
            'post' => 'required|max:280'
        ],
        [
            'post.required' => 'O post não pode estar vazio',
            'post.max' => 'O post não deve ter mais de :max caracteres'
        ]);

        $userId = auth()->user()->id;

        $post = Post::create([
            'user_id' => $userId,
            'post' => $data['post']
        ]);

        return redirect()
            ->route('home')
            ->with('success', 'Seu post foi criado com sucesso!');
    }
}
