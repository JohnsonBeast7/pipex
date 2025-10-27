@extends('layout.app')

@section('title', 'Post - PipeX')

@section('content')
<main class="min-h-screen bg-gray-700">
    <div class="flex flex-col gap-6 items-center w-full max-w-[1072px] px-6 m-auto py-7">
        <div class="self-start w-full flex flex-row gap-2 items-center">
            <p class="text-lg font-semibold text-white">Post</p>
        </div>
        <div class="w-full flex flex-col gap-2 bg-gray-800 bg-opacity-50 rounded-lg px-8 py-6">
            <div class="flex flex-row gap-3 items-center justify-between">
                <div class="flex flex-row gap-1 items-center">
                    <a href="{{ route('profile', $post->user->username) }}" class="flex flex-row gap-2 items-center">
                        <img class="w-6 h-6 rounded-full object-cover" src="{{ Storage::url($post->user->profile_pic) }}">
                        <h3 class="text-white font-medium ">{{ $post->user->nickname }}</h3>
                    </a>
                    <p class="text-gray-400 opacity-75"><span class="text-sm">&commat;</span>{{ $post->user->username }}</p>
                </div>
                @if(auth()->check() && $post->user_id == auth()->user()->id)
                                <div class="flex flex-row gap-3">
                                    <a href="{{ route('postEdit', $post->hash) }}">
                                        <img class="w-5 h-5" src="{{ asset('assets/images/edit.png') }}">    
                                    </a>                       
                                    <div class="flex flex-row gap-1">
                                        <form id="deletePost{{ $post->id }}" action="{{ route('postDelete', $post->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')                                
                                        </form>
                                        <button onclick="deletePost({{ $post->id }})">
                                            <img class="w-5 h-5" src="{{ asset('assets/images/delete.svg') }}">
                                        </button>   
                                    </div>   
                                </div>                                          
                            @endif
            </div>  
            <p class="text-gray-100">
                {{ $post->post }}
            </p>
            <div class="w-full flex flex-row gap-2 mt-4 border-b border-gray-600">
                <p class="text-gray-400 opacity-75 pb-2">{{ $post->created_at->locale('pt_BR')->translatedFormat('H:i') }}</p>
                <span class="text-gray-400 opacity-75">•</span>
                <p class="text-gray-400 opacity-75 pb-2">{{ $post->created_at->locale('pt_BR')->translatedFormat('d \d\e M \d\e Y') }}</p>
                @if($post->edited_at)
                    <span class="text-gray-400 opacity-75">•</span>
                    <p class="text-gray-400 opacity-75">Editado</p>
                @endif
            </div>
        </div>
        @livewire('comments-component', ['postId' => $post->id])
    </div>
</main>
@endsection

@push('scripts')
    @vite(['resources/js/comments-toast.js', 'resources/js/postdelete-modal.js'])
@endpush