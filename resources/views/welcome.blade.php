<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div
        class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        @if (Route::has('login'))
            <livewire:welcome.navigation />
        @endif
        <div class="relative flex items-center justify-center w-full max-w-2xl min-h-screen px-6 lg:max-w-7xl">
            <div class="items-center justify-center h-full p-6 mx-auto max-w-7xl lg:pg-8">
                <x-application-logo class="fill-current size-24 text-primary" />
                <x-button primary href="{{ route('register') }}">Get Started</x-button>
            </div>
        </div>
    </div>
</body>

</html>
