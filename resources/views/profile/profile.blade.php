@extends('layout.app')

@section('title', $user->username . " - PipeX")

@section('content')
 <main class="bg-gray-700 h-screen">
    <div class="flex flex-col items-center w-full gap-6 max-w-[1072px] px-6 m-auto pt-7 pb-12">
        <div class="self-start flex flex-row gap-1 items-center">
            <p class="text-lg font-semibold text-white">Perfil</p>
        </div>
        <div class="w-full bg-gray-800 bg-opacity-70 h-[300px] relative rounded-lg">
            <div class="h-[100px]"></div>
            <img class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full w-36 h-36 object-cover border-4 border-gray-800" src="{{ Storage::url($user->profile_pic) }}">
            <div class="flex flex-col items-center h-[200px] bg-gray-800 rounded-b-lg">
                @if(auth()->check() && $user->id == auth()->user()->id)  
                    <a class="self-end pt-3 pr-3" href="{{ route('profileEdit') }}">
                        <img class="w-5 h-5" src="{{ asset('assets/images/edit.png') }}">    
                    </a>  
                @endif
                <div class="flex flex-col items-center mt-[68px]">
                    <div class="flex flex-row gap-1 items-center">
                        <p class="text-white font-medium">{{ $user->nickname }}</p>
                    </div>            
                    <p class="text-gray-400"><span class="text-sm">&commat;</span>{{ $user->username }}</p>   
                </div>           
            </div>
        </div>
        <div class="self-start flex flex-row gap-1 items-center">
            <p class="text-lg font-semibold text-white">Posts</p>
        </div>
        @if($user->posts->isEmpty()) 
            <div class="w-full bg-gray-800 bg-opacity-50 rounded-lg px-8 py-6">
                <p class="text-white">Esse usuário ainda não tem nenhum post</p>
            </div>          
        @else     
            <div class="flex flex-col gap-12 w-full items-center">
            @foreach($user->posts as $post)
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
                        <a href="@if(!auth()->check()) {{ route('login') }}@else{{ route('post', $post->hash) }}@endif" class="flex flex-row gap-1 items-center opacity-75 group">
                            <img class="w-full max-w-4 group-hover:scale-[1.15] transition duration-700" src="{{ asset('assets/images/comment.svg') }}">
                            <p class="text-gray-400">{{ $post->comments_count }}</p>
                        </a>                  
                    </div>
                </div>
            @endforeach
            </div>
        @endif
    </div>
 </main>
@endsection

@push('scripts')
    @vite('resources/js/postdelete-modal.js')
@endpush