<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileEditComponent extends Component
{
    use WithFileUploads;

    public $user;
    public $image;
    public $nickname;
    public $username;
    public $email;

    public function mount()
    {
        $this->user = Auth::user();
        $this->nickname = $this->user->nickname;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
    }

    public function save()
    {
        $this->validate([
            'image' => 'nullable|image|max:15288',
            'nickname' => 'required|min:5|max:25',
            'username' => 'required|alpha_dash|min:5|max:30',
            'email' => 'required|email|max:255'
        ]);
        
        if($this->image) {
            
            $imageName = $this->user->id . '_' . now()->timestamp . '_' . Str::random(10) . '.' . $this->image->getClientOriginalExtension();

            $imagePath = 'profile/' . $imageName;

            if ($this->user->profile_pic !== 'profile/user.png') {
                Storage::delete($this->user->profile_pic);
            }

            $this->image->storeAs('profile', $imageName, 'public');

            $this->user->profile_pic = $imagePath;
        }

        $this->user->nickname = $this->nickname;
        $this->user->username = $this->username;
        $this->user->email = $this->email;
        $this->user->save();
        
        return redirect()
            ->route('profile', $this->user->username)
            ->with('success', 'Informações do perfil alteradas com sucesso!');
        
    }

    public function render()
    {
        return view('livewire.profile-edit-component');
    }
}
