@extends('layout.app')

@section('title', $user->username . " - PipeX")

@section('content')
 <main class="bg-gray-700 min-h-screen">
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
                <div class="flex flex-col items-center {{ auth()->check() && $user->id == auth()->user()->id ? 'mt-[48px]' : 'mt-[81px]' }}">
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
            @include('components.profile.posts-component')
        @endif
    </div>
 </main>
@endsection

@push('scripts')
    @vite('resources/js/delete-modal.js')
@endpush