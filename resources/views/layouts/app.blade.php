<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: false }" class="dark" data-theme="dark"
    x-bind:class="{ 'dark': darkMode === true }" x-bind:data-theme="darkMode ? 'dark' : 'light'" x-init="if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        localStorage.setItem('darkMode', JSON.stringify(true));
        darkMode = true;
    } else {
        darkMode = JSON.parse(localStorage.getItem('darkMode'));
    }
    $watch('darkMode', value => {
        localStorage.setItem('darkMode', JSON.stringify(value));
        document.documentElement.setAttribute('data-theme', value ? 'dark' : 'light');
    });
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
        darkMode = event.matches;
    });">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'Laravel') }}
        {{ isset($title) ? ' - ' . $title : '' }}
    </title>

    <!-- Top Scripts -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @livewireScripts
    @livewireStyles
    @vite(['resources/css/tailwind.css', 'resources/css/app.scss', 'resources/js/app.js', 'resources/js/quill.js'])

    <!-- Favicon -->
    <link href="{{ asset('favicon-dark.ico') }}" rel="icon" media="(prefers-color-scheme: light)" async />
    <link href="{{ asset('favicon-light.ico') }}" rel="icon" media="(prefers-color-scheme: dark)" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>

<body class="font-sans antialiased text-neutral-900 dark:text-[#c8c8c8]" x-cloak>
    <div class="min-h-screen bg-base-100" x-data="{ sidebarOpen: false, sidebarShrink: $persist(false) }">
        <livewire:notification />
        <livewire:components.top-bar />
        <livewire:components.side-bar />
        <main id="main" class="mt-12 transition-all"
            :class="{
                'md:ml-52': !sidebarShrink,
                'md:ml-16': sidebarShrink,
            }"
        >
            {{ $slot }}
        </main>
    </div>
</body>

</html>
