<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{   
    public function register() 
    {
        return view('auth.register');
    }

    public function login() 
    {
        return view('auth.login');
    }

    public function logout() 
    {
        Auth::logout();

        return redirect()->route('home');
    }

    public function loginSubmit(Request $request) 
    {
        $request->validate([
            'username' => 'required|alpha_dash|min:5|max:50',
            'password' => 'required|min:5|max:255'
        ],
        [
            'username.required' => 'O campo não pode estar vazio',
            'username.alpha_dash' => 'O campo não pode ter espaços',
            'username.min' => 'O campo deve ter no mínimo :min caracteres',
            'username.max' => 'O campo deve ter no máximo :max caracteres',
            'password.required' => 'O campo não pode estar vazio',
            'password.min' => 'O campo deve ter no mínimo :min caracteres',
            'password.max' => 'O campo deve ter no máximo :max caracteres'
        ]);

        $username = $request['username'];
        $password = $request['password'];

        $user = User::where('username', $username)->first();
        
        if (!$user || !Hash::check($password,$user->password)) {
            return back()
                ->withErrors(['user' => 'Usuário ou senha incorretos'])
                ->withInput();
        }

        Auth::login($user);
        
        return redirect()->route('home');
    }

    public function registerSubmit(Request $request) 
    {
        $data = $request->validate([
            'username' => 'required|alpha_dash|min:5|max:30',
            'nickname' => 'required|min:5|max:25',
            'email' => 'required|email|max:255',
            'password' => 'required|min:5|max:255|confirmed'
        ],
        [
            'username.required' => 'O campo não pode estar vazio',
            'username.alpha_dash' => 'O campo não pode ter espaços',
            'username.min' => 'O campo deve ter no mínimo :min caracteres',
            'username.max' => 'O campo deve ter no máximo :max caracteres',
            'nickname.required' => 'O campo não pode estar vazio',
            'nickname.min' => 'O campo deve ter no mínimo :min caracteres',
            'nickname.max' => 'O campo deve ter no máximo :max caracteres',
            'email.required' => 'O campo não pode estar vazio',
            'email.email' => 'O valor do campo deve ser um email',
            'email.max' => 'O campo deve ter no máximo :max caracteres',
            'password.required' => 'O campo não pode estar vazio',
            'password.min' => 'O campo deve ter no mínimo :min caracteres',
            'password.max' => 'O campo deve ter no máximo :max caracteres',
            'password.confirmed' => 'Os campos de senha não coincidem',
        ]);
        
        if (User::where('username', $data['username'])->exists()) {
            return back()
                ->withErrors(['user' => 'Já existe um usuário com esse nome']);
        }

        if (User::where('email', $data['email'])->exists()) {
            return back()
                ->withErrors(['user' => 'Já existe um usuário com esse email']);
        }

        $user = User::create([
            'username' => $data['username'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        Auth::login($user);

        return redirect()
            ->route('home');

    }

}
