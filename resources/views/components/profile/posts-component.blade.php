<div class="flex flex-col gap-12 w-full items-center">
    @foreach($user->posts as $post)
        <div id="post-{{ $post->hash }}" class="w-full flex flex-col gap-2 bg-gray-800 bg-opacity-50 rounded-lg px-8 py-6">
            <div class="flex flex-row gap-3 items-center justify-between">
                <div class="w-full flex md:flex-row flex-col gap-2 md:items-center items-start">
                    <div class="w-full max-w-fit flex xs:flex-row flex-col gap-1 xs:items-center items-start">
                        <a href="{{ !auth()->check() ? route('login') : route('profile', $post->user->username) }}" class="flex flex-row gap-2 items-center">
                            <img class="w-6 h-6 rounded-full object-cover" src="{{ Storage::url($post->user->profile_pic) }}">
                            <h3 class="text-white font-medium md:max-w-full xs:max-w-[150px] max-w-[200px] truncate">{{ $post->user->nickname }}</h3>
                        </a>
                        <p class="text-gray-400 opacity-75 md:max-w-full xs:max-w-[150px] max-w-[200px] truncate"><span class="text-sm">&commat;</span>{{ $post->user->username }}</p>
                    </div>
                    <span class="text-gray-400 opacity-75 md:flex hidden">•</span>
                    <div class="max-w-fit w-full justify-between flex flex-row gap-2">
                        <div class="flex flex-row gap-2">
                            <p class="text-gray-400 opacity-75">{{ $post->created_at->locale('pt_BR')->translatedFormat('d \d\e M') }}</p>
                            @if($post->edited_at)
                                <span class="text-gray-400 opacity-75">•</span>
                                <p class="text-gray-400 opacity-75">Editado</p>
                            @endif
                        </div>                  
                        @if(auth()->check() && $post->user_id == auth()->user()->id)
                            <div class="flex md:hidden items-center flex-row gap-2 ml-3">
                                <a href="{{ route('postEdit', $post->hash) }}">
                                    <img class="w-4 h-4" src="{{ asset('assets/images/edit.png') }}">    
                                </a>                       
                                <div class="flex flex-row gap-1">
                                    <form id="deletePost{{ $post->id }}" action="{{ route('postDelete', $post->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')                                
                                    </form>
                                    <button onclick="confirmDelete('deletePost', {{ $post->id }})">
                                        <img class="w-4 h-4" src="{{ asset('assets/images/delete.svg') }}">
                                    </button>   
                                </div>   
                            </div>                                          
                        @endif
                    </div>                                        
                </div>                        
                @if(auth()->check() && $post->user_id == auth()->user()->id)
                    <div class="w-full max-w-fit md:flex hidden flex-row gap-2 ">
                        <a href="{{ route('postEdit', $post->hash) }}">
                            <img class="w-5 h-5" src="{{ asset('assets/images/edit.png') }}">    
                        </a>                       
                        <div class="flex flex-row gap-1">
                            <form id="deletePost{{ $post->id }}" action="{{ route('postDelete', $post->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')                                
                            </form>
                            <button onclick="confirmDelete('deletePost', {{ $post->id }})">
                                <img class="w-5 h-5" src="{{ asset('assets/images/delete.svg') }}">
                            </button>   
                        </div>   
                    </div>                                          
                @endif
            </div> 
            <p class="text-gray-100 break-all">
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