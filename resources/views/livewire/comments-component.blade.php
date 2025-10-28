<div class="w-full flex flex-col gap-6">
    <div class="w-full flex flex-col gap-2 bg-gray-800 bg-opacity-50 rounded-lg px-8 py-6">
        <p class="text-white text-lg font-semibold">Escreva algo:</p>
        <textarea wire:model="comment" name="comment" id="comment" class="w-full rounded-lg resize-none bg-gray-800 bg-opacity-0 focus:outline-none py-2 text-gray-100" rows="3" placeholder="Parabéns amigo, muitas felicidades!" maxlength="300"></textarea>
        <button wire:click="commentCreate" class="w-fit bg-gray-100 hover:bg-gray-200 transition duration-300 text-neutral-800 font-semibold px-4 py-2 rounded-lg" type="button">Postar</button>
        @error('comment') <p class="text-red-500 text-sm sm:text-base">{{ $message }}</p> @enderror
    </div>
    
        
    <div class="w-full flex flex-col gap-2 bg-gray-800 bg-opacity-50 rounded-lg px-8 py-6">
        <div class="flex flex-row gap-1 items-center pb-2">
            @if($comments->count() != 0)
                <p class="text-gray-200 text-lg font-semibold">{{ $comments->count() }}</p>
            @endif
            <p class="text-white text-lg font-semibold"> {{ Str::plural('Comentário', $comments->count()) }} </p>
        </div>
        
        <div class="flex flex-col gap-2">
            @if($comments->isEmpty())
                <p class="text-white pt-2">Ainda não existe nenhum comentário nessa publicação.</p>
            @else
                @foreach($comments as $comment)
                    <div class="w-full flex flex-col gap-2 pt-4 pb-6 border-b border-gray-600">
                        <div class="flex md:flex-row flex-col gap-2 md:items-center items-start">
                            <div class="flex xs:flex-row flex-col gap-1 xs:items-center items-start">
                                <a href="{{ route('profile', $comment->user->username) }}" class="flex flex-row gap-2 items-center">
                                    <img class="w-6 h-6 rounded-full object-cover" src="{{ Storage::url($comment->user->profile_pic) }}">
                                    <h3 class="text-white font-medium md:max-w-full xs:max-w-[150px] max-w-[200px] truncate">{{ $comment->user->nickname }}</h3>
                                </a>
                                <p class="text-gray-400 opacity-75 md:max-w-full xs:max-w-[150px] max-w-[200px] truncate"><span class="text-sm">&commat;</span>{{ $comment->user->username }}</p>
                            </div>    
                            <span class="text-gray-400 opacity-75 md:flex hidden">•</span>    
                            <p class="text-gray-400 opacity-75">{{ $comment->created_at->locale('pt_BR')->translatedFormat('d \d\e M') }}</p>
                        </div>  
                        <p class="text-gray-100">
                            {{ $comment->comment }}
                        </p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>