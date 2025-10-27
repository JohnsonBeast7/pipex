<header class="bg-gray-800 py-8 @if (!Route::is(['login', 'register', 'profile', 'profileEdit'])) sticky top-0 @endif w-full z-50">
    <div class="min-h-16 flex flex-row justify-between items-center w-full max-w-[1324px] px-6 m-auto">
        <div class="flex flex-col gap-1">
            <a href="{{ route('home') }}" class="w-full @guest md:max-w-[185px] max-w-fit @endguest @auth max-w-fit @endauth flex flex-row items-center">
                <h1 class="text-white md:text-5xl text-3xl font-medium">Pipe</h1>
                <span class="text-sky-500 font-bold md:text-6xl text-4xl">X</span>
            </a>  
            @if(Route::is('home'))
                <a href="{{ route('postMake') }}" class="block md:hidden text-white md:text-xl text-xs font-semibold bg-sky-500 hover:bg-sky-600 hover:scale-110 transition duration-300 md:px-6 md:py-3 px-3 py-2 rounded-lg text-center">Publicar!</a>    
            @endif 
        </div>
        
        @if(Route::is('home'))
            <a href="{{ route('postMake') }}" class="md:flex hidden text-white md:text-xl text-xs font-semibold bg-sky-500 hover:bg-sky-600 hover:scale-110 transition duration-300 md:px-6 md:py-3 px-3 py-2 rounded-lg">Publicar!</a>    
        @endif 
        @if(!Route::is(['login', 'register', 'profileEdit']))      
            @guest
                <div class="flex flex-col items-center gap-1">
                    <p class="text-white md:text-base text-xs font-normal"><a href="{{ route('login') }}" class="text-sky-500 font-medium hover:font-semibold transition duration-500">Entrar</a> na minha conta.</p>
                    <p class="text-white md:text-base text-xs font-normal">Não tem uma? <a href="{{ route('register') }}" class="text-sky-500 font-medium hover:font-semibold transition duration-500">Crie</a> agora!</p>
                </div>
            @endguest

            @auth
                <div class="flex flex-col items-center gap-1">            
                    <div class="flex flex-col gap-1 items-center min-w-[131px]">
                        <a href="{{ route('profile', auth()->user()->username) }}">
                        <img class="w-8 h-8 rounded-full object-cover" src="{{ Storage::url(auth()->user()->profile_pic) }}">
                        </a>
                        <a href="{{ route('logout') }}" class="text-white text-lg font-semibold">Sair</a>
                    </div>
                </div>
            @endauth
        @endif
        
    </div>
</header>