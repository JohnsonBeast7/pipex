<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;
use Livewire\WithPagination;

class CommentsComponent extends Component
{
    use WithPagination;
    public Collection $comments;
    public $comment = '';
    public $postId;

    public function mount() 
    {     
        $this->comments = Comment::where('post_id', $this->postId)
            ->with('user:id,username,nickname,profile_pic')
            ->latest()
            ->get();
    }

    public function commentCreate() 
    {
        $key = 'comment:'.Auth::id();

        if (RateLimiter::tooManyAttempts($key, 1)) {
            $seconds = RateLimiter::availableIn($key);
            $this->dispatch(
                event: 'toast',
                type: 'error',
                message: "Espere {$seconds}s para comentar novamente."
            );
            return;
        }

        RateLimiter::hit($key, 10);

        try {
            Post::findOrFail($this->postId);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('home');
        }

        $this->validate([
            'comment' => 'required|max:300'
        ]);

        Comment::create([
            'post_id' => $this->postId,
            'user_id' => Auth::id(),
            'comment' => $this->comment
        ]);

        $this->reset('comment');

        $this->dispatch(
            event: 'toast',
            type: 'success',
            message: 'Comentário registrado com sucesso!'         
        );
        
        $this->comments = Comment::where('post_id', $this->postId)
            ->with('user:id,username,nickname,profile_pic')
            ->latest()
            ->get();
    }
    
    public function render()
    {
        return view('livewire.comments-component');
    }
}
