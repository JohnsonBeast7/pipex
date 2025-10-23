@extends('layout.app')

@section('title', 'PipeX')

@section('content')
    <main class="min-h-screen bg-gray-700">
        <div class="flex flex-col gap-12 items-center w-full max-w-[1072px] px-6 m-auto py-20">
            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function(){
                        Swal.fire({
                            icon: 'success',
                            title: "{{ session('success') }}",
                            closeButtonText: 'fechar'
                            timer: 3000,
                        })
                    });
                </script>
            @endif
            @if(!$posts->isEmpty()) 
                @foreach($posts as $post)
                    <div class="w-full flex flex-col gap-2 bg-gray-800 bg-opacity-50 rounded-lg px-8 py-6">
                        <div class="flex flex-row gap-4 items-center">
                            <h3 class="text-white font-medium">{{ $post->user->username }}</h3>
                            <p class="text-gray-100 opacity-75">{{ $post->created_at->locale('pt_BR')->translatedFormat('d \d\e M') }}</p>
                            @if(auth()->check() && $post->user_id == auth()->user()->id) Delete @endif
                        </div>  
                        <p class="text-gray-100">
                            {{ $post->post }}
                        </p>
                        <div class="flex flex-row mt-2">
                            <div class="flex flex-row gap-1 items-center opacity-75 hover:cursor-pointer group">
                                <img class="w-full max-w-4 group-hover:scale-[1.15] transition duration-700" src="{{ asset('assets/images/comment.svg') }}">
                                <p class="text-gray-100 ">15</p>
                            </div>                  
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="flex row gap-2">
                {{ $posts->links('pagination::tailwind') }}
            </div>
            
        </div>
    </main>
@endsection