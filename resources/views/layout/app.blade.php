<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'PipeX')</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles()
</head>
<body>
    @include('structure.header')

    @yield('content')

    @include('structure.footer')

    @stack('scripts')
    @livewireScripts

    <script>      
            document.addEventListener('DOMContentLoaded', () => {
                @if (session('success'))
                    Swal.fire({
                        toast: true,
                        icon: "success", 
                        iconColor: "#ffffff",     
                        title: @json(session('success')),
                        position: "bottom",
                        background: "#0ea5e9",
                        color: "#fff",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        customClass: {
                            timerProgressBar: 'bg-white text-white'
                        }
                    });
                @elseif (session('error'))
                    Swal.fire({
                        toast: true,
                        icon: "error", 
                        iconColor: "#ffffff",     
                        title: @json(session('error')),
                        position: "bottom",
                        background: "#0ea5e9",
                        color: "#fff",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        customClass: {
                            timerProgressBar: 'bg-white text-white'
                        }
                    });
                @endif
            });      
    </script>
</body>
</html>
