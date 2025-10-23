<header class="bg-gray-800 py-8  @if (!Route::is(['login', 'register'])) sticky top-0 @endif w-full z-50">
    <div class="flex flex-row justify-between items-center w-full max-w-[1324px] px-6 m-auto">
        <a href="{{ route('home') }}" class="flex flex-row items-center">
            <h1 class="text-white text-5xl font-medium">Pipe</h1>
            <span class="text-sky-500 font-bold text-6xl">X</span>
        </a>       
        @if(!Route::is(['login', 'register']))
            <a href="{{ route('postMake') }}" class="text-white text-xl font-semibold bg-sky-500 hover:bg-sky-600 hover:scale-110 transition duration-300 px-6 py-3 rounded-lg">Publicar!</a>
            @guest
                <div class="flex flex-col items-center gap-1 ">
                    <p class="text-white font-normal"><a href="{{ route('login') }}" class="text-sky-500 font-medium hover:font-semibold transition duration-500">Entrar</a> na minha conta.</p>
                    <p class="text-white font-normal">Não tem uma conta? <a href="{{ route('register') }}" class="text-sky-500 font-medium hover:font-semibold transition duration-500">Crie</a> agora!</p>
                </div>
            @endguest

            @auth
                <div class="flex flex-col items-center gap-1 ">
                    <p class="text-white font-normal"><span href="{{ route('login') }}" class="text-sky-500 font-medium hover:font-semibold transition duration-500">Bem-vindo</span> {{  auth()->user()->username }}</p>
                    <div class="flex flex-row gap-2">
                        <a href="#" class="text-white font-medium">Conta</a>
                        <span class="text-white font-medium">|</span>
                        <a href="{{ route('logout') }}" class="text-white font-medium">Sair</a>
                    </div>
                    
                </div>
            @endauth
        @endif
        
    </div>
</header>