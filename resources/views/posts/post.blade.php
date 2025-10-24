@extends('layout.app')

@section('title', 'Post - PipeX')

@section('content')
<main class="min-h-screen bg-gray-700">
    <div class="flex flex-col gap-6 items-center w-full max-w-[1072px] px-6 m-auto py-7">
        <div class="self-start flex flex-row gap-1 items-center">
            <a class="w-full max-w-6" href="{{ url()->previous() }}"><img src="{{ asset('assets/images/back-arrow.svg') }}"></a>
            <p class="text-lg font-semibold text-white">Post</p>
        </div>
        <div class="w-full flex flex-col gap-2 bg-gray-800 bg-opacity-50 rounded-lg px-8 py-6">
            <div class="flex flex-row gap-3 items-center">
                <div class="flex flex-row gap-2 items-center">
                    <img class="max-w-6 max-h-6" src="{{ Storage::url($post->user->profile_pic) }}">
                    <h3 class="text-white font-medium text-lg">{{ $post->user->username }}</h3>
                </div>   
                @if(auth()->check() && $post->user_id == auth()->user()->id) Delete @endif
            </div>  
            <p class="text-gray-100">
                {{ $post->post }}
            </p>
            <div class="flex flex-col gap-2 mt-4">
                <p class="text-gray-400 opacity-75 border-b border-gray-600 pb-2">{{ $post->created_at->locale('pt_BR')->translatedFormat('H:i \-\ d \d\e M \d\e Y') }}</p>
                <div class="flex flex-row gap-1 opacity-75">
                    <img class="w-full max-w-4 group-hover:scale-[1.15] transition duration-700" src="{{ asset('assets/images/comment.svg') }}">
                    <p class="text-gray-400 ">{{ $post->comments_count }}</p>                 
                </div>
            </div>
        </div>
        @livewire('comments-component', ['postId' => $post->id])
    </div>
</main>
@endsection

@push('scripts')
    @vite('resources/js/comments-toast.js')
@endpush