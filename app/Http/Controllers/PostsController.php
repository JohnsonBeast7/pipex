<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PostsController extends Controller
{
    public function postMake() 
    {
        if(!Auth::check()) {
            return redirect()
                ->route('login')
                ->with('');
        }

        return view('posts.post-make');
    }

    public function postCreate(Request $request) 
    {
        $data = $request->validate([
            'post' => 'required|max:380'
        ],
        [
            'post.required' => 'O post não pode estar vazio',
            'post.max' => 'O post não deve ter mais de :max caracteres'
        ]);

        $userId = Auth::id();

        $post = Post::create([
            'user_id' => $userId,
            'hash' => (string) Str::uuid(),
            'post' => $data['post']
        ]);

        return redirect()
            ->route('home')
            ->with('success', 'Seu post foi criado com sucesso!');
    }

    public function postDelete($postId) {
        try {
            $post = Post::where('id', $postId)
                ->where('user_id', Auth::id())
                ->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()
                ->route('home')
                ->with('error', 'Impossível deletar esse post!');
        }

        $post->delete();

        return redirect()
            ->route('home')
            ->with('success', 'Seu post foi deletado com sucesso!');
    }

    public function post($hash)
    {   
        try {
            $post = Post::where('hash', $hash)
                ->with('user:id,username,profile_pic')
                ->withCOunt('comments')
                ->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return view('fallback',['fallback' => 'post']);
        }
        
        return view('posts.post', ['post' => $post]);
    }
}
