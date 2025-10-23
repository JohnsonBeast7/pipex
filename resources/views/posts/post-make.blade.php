@extends('layout.app')

@section('title', 'Novo Post - PipeX')

@section('content')
    <main class="min-h-screen bg-gray-700">
        <div class="flex flex-col items-center w-full max-w-[1072px] px-6 m-auto py-20">
            <div class="w-full flex flex-col gap-2 bg-gray-800 bg-opacity-50 rounded-lg px-8 pb-10 pt-6">
                <div class="flex flex-row gap-4 items-center">
                    <label class="w-full text-white text-lg font-medium border-b border-gray-600 pb-2" for="post">Crie seu novo post</label>
                </div>  
                <form action="{{ route('postCreate') }}" method="POST" class="w-full flex flex-col gap-2">
                    @csrf
                    <textarea name="post" id="post" class="w-full rounded-lg resize-none bg-gray-800 bg-opacity-0 focus:outline-none py-2 text-gray-100" rows="4" placeholder="Adotei um gato branco hoje!" maxlength="380"></textarea>
                    
                    <button class="w-fit bg-gray-100 hover:bg-gray-200 transition duration-300 text-neutral-800 font-semibold px-4 py-2 rounded-lg " type="submit">Postar</button>
                    @error('post') <p class="text-red-500 text-sm sm:text-base">{{ $message }}</p> @enderror
                </form>
            </div>
        </div>
    </main>
@endsection