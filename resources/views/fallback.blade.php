@extends('layout.app')

@section('title', '404 - Pipex')

@section('content')
    <main class="min-h-screen bg-gray-700">
        <div class="flex flex-col gap-6 items-center w-full max-w-[1072px] px-6 m-auto py-20">
            <h3 class="text-white text-9xl font-bold">404</h3>
            <p class="text-white text-3xl font-medium">Ops... parece que esse <span class="font-bold text-sky-500">{{ $fallback }}</span> não existe</p>
            <a href="{{ route('home') }}" class="text-white text-lg font-semibold bg-sky-500 hover:bg-sky-600 hover:scale-110 transition duration-300 px-6 py-3 rounded-lg">Início</a>
        </div>
    </main>
@endsection