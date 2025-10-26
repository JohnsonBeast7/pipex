<header class="bg-gray-800 py-8 @if (!Route::is(['login', 'register'])) sticky top-0 @endif w-full z-50">
    <div class="min-h-16 flex flex-row justify-between items-center w-full max-w-[1324px] px-6 m-auto">
        <a href="{{ route('home') }}" class="w-full @guest max-w-[185px] @endguest @auth max-w-fit @endauth flex flex-row items-center">
            <h1 class="text-white text-5xl font-medium">Pipe</h1>
            <span class="text-sky-500 font-bold text-6xl">X</span>
        </a>  
        @if(Route::is('home'))
            <a href="{{ route('postMake') }}" class="text-white text-xl font-semibold bg-sky-500 hover:bg-sky-600 hover:scale-110 transition duration-300 px-6 py-3 rounded-lg">Publicar!</a>    
        @endif 
        @if(!Route::is(['login', 'register']))      
            @guest
                <div class="flex flex-col items-center gap-1 ">
                    <p class="text-white font-normal"><a href="{{ route('login') }}" class="text-sky-500 font-medium hover:font-semibold transition duration-500">Entrar</a> na minha conta.</p>
                    <p class="text-white font-normal">Não tem uma? <a href="{{ route('register') }}" class="text-sky-500 font-medium hover:font-semibold transition duration-500">Crie</a> agora!</p>
                </div>
            @endguest

            @auth
                <div class="flex flex-col items-center gap-1">            
                    <div class="flex flex-col gap-1 items-center">
                        <img class="max-w-8 max-h-8" src="{{ Storage::url(auth()->user()->profile_pic) }}">
                        <a href="{{ route('logout') }}" class="text-white text-lg font-semibold">Sair</a>
                    </div>
                </div>
            @endauth
        @endif
        
    </div>
</header>