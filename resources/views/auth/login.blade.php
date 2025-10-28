@extends('layout.app')

@section('title', 'Login - PipeX')

@section('content')
 <main class="h-screen bg-gray-700">
    <div class="flex flex-col items-center w-full max-w-[1072px] px-6 m-auto py-20">
        <div class="flex flex-col gap-4 items-center w-full max-w-[512px] bg-gray-800 shadow-md py-10 px-6">
            <div class="flex flex-row items-center gap-1">
                <h2 class="text-white text-3xl font-semibold">Login</h2>
                <span class="text-white font-semibold text-3xl">-</span>
                <p class="text-white font-semibold text-3xl">P<span class="font-bold text-4xl text-sky-500">X</span></p>
            </div>
            
            <form action="{{ route('loginSubmit') }}" method="POST" class="flex flex-col gap-6 w-full max-w-[75%]">
                @csrf
                <div class="flex flex-col gap-1 w-full">
                    <label for="username" class="text-white font-medium">Usuário</label>
                    <input type="text" id="username" name="username" placeholder="Digite seu usuário" class="w-full bg-gray-100 focus:ring-0 focus:outline-none px-2 py-2 rounded-lg text-neutral-800" value="{{ old('username') }}" oninput="this.value = this.value
                    .replace(/\s/g, '')
                    .normalize('NFD').replace(/[\u0300-\u036f]/g, '');"
                >
                    @error('username') <p class="text-red-500 text-sm sm:text-base">{{ $message }}</p> @enderror            
                </div>
                <div class="flex flex-col gap-1 w-full">
                    <label for="password" class="text-white font-medium">Senha</label>
                    <input type="password" id="password" name="password" placeholder="Digite sua senha" class="w-full bg-gray-100 focus:ring-0 focus:outline-none px-2 py-2 rounded-lg text-neutral-800" autocomplete="off">
                    @error('password') <p class="text-red-500 text-sm sm:text-base">{{ $message }}</p> @enderror
                </div>
                @error('user')
                    <p class="bg-sky-200 text-sky-600 rounded-lg border border-sky-600 text-center font-medium text-sm sm:text-base w-full py-4 px-4">
                        {{ $message }}
                    </p>
                @enderror
                <div class="flex flex-col gap-2 items-center">
                    <button type="submit" class="bg-sky-500 hover:bg-sky-600 transition duration-300 text-white font-semibold w-full max-w-fit m-auto py-2 px-6 rounded-lg">Entrar</button>
                    <p class="text-white">ou <a href="{{ route('register') }}" class="text-sky-500 hover:text-sky-600 transition duration-300 font-semibold">Registrar</a></p>
                </div>
            </form>
        </div>
    </div>
 </main>
@endsection