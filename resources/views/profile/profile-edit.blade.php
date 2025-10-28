@extends('layout.app')

@section('title', "Editar Perfil - PipeX")

@section('content')
 <main class="bg-gray-700 min-h-screen">
    <div class="flex flex-col items-center w-full gap-6 max-w-[1072px] px-6 m-auto pt-7 pb-12">
        <div class="self-start flex flex-row gap-1 items-center">
            <p class="text-lg font-semibold text-white">Editar Perfil</p>
        </div>
        @livewire('profile-edit-component')
    </div>
 </main>
@endsection

@push('scripts')
    @vite('resources/js/delete-modal.js')
@endpush