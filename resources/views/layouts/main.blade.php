<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('strings.task manager') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <header class="border-b border-gray-200">
            <div class="container mx-auto flex items-center justify-between p-4">
                <a href="{{ route('home') }}" class="text-lg font-semibold">
                    {{ __('strings.task manager') }}
                </a>
                <nav class="flex items-center gap-4">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-blue-600 hover:underline">
                                {{ __('strings.log out') }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
                            {{ __('strings.log in') }}
                        </a>
                        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">
                            {{ __('strings.registration') }}
                        </a>
                    @endauth
                </nav>
            </div>
        </header>

        <main class="container mx-auto p-8">
            @include('flash::message')
            @yield('content')
        </main>
    </body>
</html>
