<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;


class PostsController extends Controller
{
    public function postMake() 
    {
        if(!Auth::check()) {
            return redirect()
                ->route('login');
        }

        return view('posts.post-make');
    }

    public function postCreate(Request $request) 
    {
        $key = 'post:' . Auth::id();

        if (RateLimiter::tooManyAttempts($key, 1)) {
            $seconds = RateLimiter::availableIn($key);
            return back()
                ->withInput()
                ->with('error', "Espere {$seconds}s para criar um post novamente.");
        }

        RateLimiter::hit($key, 10);
        
        $data = $request->validate([
            'post' => 'required|max:380'
        ],
        [
            'post.required' => 'O post não pode estar vazio',
            'post.max' => 'O post não deve ter mais de :max caracteres'
        ]);
    
        Post::create([
            'user_id' => Auth::id(),
            'hash' => (string) Str::uuid(),
            'post' => $data['post']
        ]);

        return redirect()
            ->route('home')
            ->with('success', 'Seu post foi criado com sucesso!');
    }

    public function postDelete($postId) 
    {
        try {
            $post = Post::where('id', $postId)
                ->where('user_id', Auth::id())
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return back()
                ->with('error', 'Impossível deletar esse post!');
        }

        $post->delete();

        return redirect()
            ->route('home')
            ->with('success', 'Seu post foi deletado com sucesso!');
    }

    public function postEdit($postHash) 
    {
        try {
            $post = Post::where('hash', $postHash)
                ->where('user_id', Auth::id())
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return back()
                ->with('error', 'Impossível editar esse post!');
        }

        return view('posts.post-edit', compact('post'));         
    }

    public function postUpdate(Request $request, $postHash)
    {
        try {
            $post = Post::where('hash',$postHash)
                ->where('user_id', Auth::id())
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('home')
                ->with('error', 'Impossível editar esse post!');
        }

        $data = $request->validate([
            'post' => 'required|max:380'
        ],
        [
            'post.required' => 'O post não pode estar vazio',
            'post.max' => 'O post não deve ter mais de :max caracteres'
        ]);  
        
        $post->update([
            'post' => $data['post'],
            'edited_at' => now()
        ]);

        return redirect()
            ->route('post', $post->hash)
            ->with('success', 'Seu post foi editado com sucesso!');
    }

    public function post($hash)
    {  
        try {
            $post = Post::where('hash', $hash)
                ->with('user:id,username,nickname,profile_pic')
                ->withCount('comments')
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return view('fallback',['fallback' => 'post']);
        }
        
        return view('posts.post', compact('post'));
    }
}
