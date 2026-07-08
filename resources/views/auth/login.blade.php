<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6">
        <h1 class="auth-title">
            <a href="{{ route('home') }}" class="transition hover:text-blue-600">
                {{ __('strings.task manager') }}
            </a>
        </h1>
        <p class="auth-subtitle">{{ __('strings.log in') }}</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="form-label" />
            <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="form-error" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Пароль')" class="form-label" />
            <x-text-input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="form-error" />
        </div>

        <div>
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ml-2 text-sm text-slate-600">{{ __('Запомнить меня') }}</span>
            </label>
        </div>

        <div class="flex flex-col gap-4 pt-2 sm:flex-row sm:items-center sm:justify-between">
            @if (Route::has('password.request'))
                <a class="btn-secondary underline-offset-2 hover:underline" href="{{ route('password.request') }}">
                    {{ __('Забыли пароль?') }}
                </a>
            @endif

            <x-primary-button class="btn-primary sm:ml-auto">
                {{ __('Войти') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
