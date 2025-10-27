@extends('layout.app')

@section('title', 'PipeX')

@section('content')
    <main class="min-h-screen bg-gray-700">
        <div class="flex flex-col gap-6 items-center w-full max-w-[1072px] px-6 m-auto py-7">
            @if($posts->isEmpty()) 
                <div class="text-white text-xl font-medium">
                    <p>Ainda não existe nenhum post, que tal criar o primeiro?</p>
                </div>          
            @else
                <div class="self-start flex flex-row gap-1 items-center">
                    <p class="text-lg font-semibold text-white">Início</p>
                </div>
                <div class="flex flex-col gap-12 w-full items-center">
                @foreach($posts as $post)
                    <div id="post-{{ $post->hash }}" class="w-full flex flex-col gap-2 bg-gray-800 bg-opacity-50 rounded-lg px-8 py-6">
                        <div class="flex flex-row gap-3 items-center justify-between">
                            <div class="flex md:flex-row flex-col gap-2 md:items-center items-start">
                                <div class="flex xs:flex-row flex-col gap-1 items-center">
                                    <a href="{{ !auth()->check() ? route('login') : route('profile', $post->user->username) }}" class="flex flex-row gap-2 items-center">
                                        <img class="w-6 h-6 rounded-full object-cover" src="{{ Storage::url($post->user->profile_pic) }}">
                                        <h3 class="text-white font-medium md:max-w-full xs:max-w-[150px] max-w-[200px] truncate">{{ $post->user->nickname }}</h3>
                                    </a>
                                    <p class="text-gray-400 opacity-75 md:max-w-full xs:max-w-[150px] max-w-[200px] truncate"><span class="text-sm">&commat;</span>{{ $post->user->username }}</p>
                                </div>
                                <span class="text-gray-400 opacity-75 md:flex hidden">•</span>
                                <div class="flex flex-row gap-2">
                                    <p class="text-gray-400 opacity-75">{{ $post->created_at->locale('pt_BR')->translatedFormat('d \d\e M') }}</p>
                                    @if($post->edited_at)
                                        <span class="text-gray-400 opacity-75">•</span>
                                        <p class="text-gray-400 opacity-75">Editado</p>
                                    @endif
                                    @if(auth()->check() && $post->user_id == auth()->user()->id)
                                        <div class="flex sm:hidden items-center flex-row gap-2 ml-3">
                                            <a href="{{ route('postEdit', $post->hash) }}">
                                                <img class="w-4 h-4" src="{{ asset('assets/images/edit.png') }}">    
                                            </a>                       
                                            <div class="flex flex-row gap-1">
                                                <form id="deletePost{{ $post->id }}" action="{{ route('postDelete', $post->id) }}" method="POST" class="hidden">
                                                    @csrf
                                                    @method('DELETE')                                
                                                </form>
                                                <button onclick="deletePost({{ $post->id }})">
                                                    <img class="w-4 h-4" src="{{ asset('assets/images/delete.svg') }}">
                                                </button>   
                                            </div>   
                                        </div>                                          
                                    @endif
                                </div>                                        
                            </div>                        
                            @if(auth()->check() && $post->user_id == auth()->user()->id)
                                <div class="sm:flex hidden flex-row gap-3">
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
                        <div class="flex flex-row mt-2">
                            <a href="{{ !auth()->check() ? route('login') : route('post', $post->hash) }}" class="flex flex-row gap-1 items-center opacity-75 group">
                                <img class="w-full max-w-4 group-hover:scale-[1.15] transition duration-700" src="{{ asset('assets/images/comment.svg') }}">
                                <p class="text-gray-400">{{ $post->comments_count }}</p>
                            </a>                  
                        </div>
                    </div>
                @endforeach
                </div>
            @endif
            <div class="flex row gap-2">
                {{ $posts->links('pagination::tailwind') }}
            </div>         
        </div>
    </main>       
@endsection

@push('scripts')
    @vite('resources/js/postdelete-modal.js')
@endpush

