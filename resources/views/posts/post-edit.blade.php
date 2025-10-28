@extends('layout.app')

@section('title', 'Post - PipeX')

@section('content')
<main class="min-h-screen bg-gray-700">
    <div class="flex flex-col gap-6 items-center w-full max-w-[1072px] px-6 m-auto py-7">
        <div class="self-start flex flex-row gap-1 items-center">
            <a class="w-full max-w-6" href="{{ route('post', $post->hash) }}"><img src="{{ asset('assets/images/back-arrow.svg') }}"></a>
            <p class="text-lg font-semibold text-white">Editar Post</p>
        </div>
        <div class="w-full flex flex-col gap-2 bg-gray-800 bg-opacity-50 rounded-lg px-8 py-6">
            <div class="flex flex-row gap-3 items-center">
                <div class="flex flex-row gap-2 items-center">
                    <img class="w-6 h-6 rounded-full object-cover" src="{{ Storage::url($post->user->profile_pic) }}">
                    <h3 class="text-white font-medium text-lg">{{ $post->user->username }}</h3>
                </div>   
            </div>
            <form action="{{route('postUpdate', $post->hash) }}" method="POST" class="flex flex-col gap-4"> 
                @csrf
                @method('PUT')
                <textarea name="post" class="w-full bg-gray-800 focus:ring-0 focus:outline-none bg-opacity-50 px-2 py-2 rounded-lg text-white resize-none" rows="4" maxlength="380">{{ $post->post }}</textarea> 
                @error('post') <p class="text-red-500 text-sm sm:text-base">{{ $message }}</p> @enderror   
                <button class="w-fit bg-gray-100 hover:bg-gray-200 transition duration-300 text-neutral-800 font-semibold px-4 py-2 rounded-lg " type="submit">Salvar</button>
            </form>
            <div class="flex flex-col gap-2 mt-4">
                <p class="text-gray-400 opacity-75 border-b border-gray-600 pb-2">{{ $post->created_at->locale('pt_BR')->translatedFormat('H:i \-\ d \d\e M \d\e Y') }}</p>
            </div>
        </div>
    </div>
</main>
@endsection

{{-- @push('scripts')

@endpush --}}