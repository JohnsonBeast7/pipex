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
                @include('components.home.posts-component')
            @endif
            <div class="flex row gap-2">
                {{ $posts->links('pagination::tailwind') }}
            </div>         
        </div>
    </main>       
@endsection

@push('scripts')
    @vite('resources/js/delete-modal.js')
@endpush

