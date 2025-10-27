<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class ProfileController extends Controller
{
    use WithFileUploads;
    public function profile($username) 
    {
        try {
            $user = User::where('username', $username)
                ->with([
                    'posts' => function ($q) {
                        $q->withCount('comments')
                            ->latest();
                    }
                ])
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return view('fallback',['fallback' => 'perfil']);
        }  
        
        return view('profile.profile', compact('user'));
    }

    public function profileEdit() 
    {
        $user = Auth::user();

        return view('profile.profile-edit', compact('user'));
    }
}
