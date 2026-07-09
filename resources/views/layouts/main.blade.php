<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token">
        <title>{{ __('strings.task manager') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen font-sans antialiased">
        <header class="app-header">
            <div class="app-container flex flex-wrap items-center justify-between gap-4 py-4">
                <a href="{{ route('home') }}" class="app-brand">
                    {{ __('strings.task manager') }}
                </a>
                <nav class="flex flex-wrap items-center gap-4">
                    <a href="{{ route('tasks.index') }}" class="header-nav-link">
                        {{ __('strings.tasks') }}
                    </a>
                    <a href="{{ route('task_statuses.index') }}" class="header-nav-link">
                        {{ __('strings.statuses') }}
                    </a>
                    <a href="{{ route('labels.index') }}" class="header-nav-link">
                        {{ __('strings.labels') }}
                    </a>
                    @auth
                        <a
                            data-method="post"
                            href="{{ route('logout') }}"
                            class="nav-button"
                        >{{ __('strings.log out') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="header-nav-link">
                            {{ __('strings.log in') }}
                        </a>
                        <a href="{{ route('register') }}" class="nav-link-primary">
                            {{ __('strings.registration') }}
                        </a>
                    @endauth
                </nav>
            </div>
        </header>

        <main class="app-container py-8 sm:py-10">
            @include('flash::message')
            @yield('content')
        </main>
    </body>
</html>
