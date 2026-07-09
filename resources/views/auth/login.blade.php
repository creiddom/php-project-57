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
            <x-input-label for="email" :value="__('strings.email')" class="form-label" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            @error('email')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <x-input-label for="password" :value="__('strings.password')" class="form-label" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            @error('password')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ml-2 text-sm text-slate-600">{{ __('strings.remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col gap-4 pt-2 sm:flex-row sm:items-center sm:justify-between">
            @if (Route::has('password.request'))
                <a class="btn-secondary underline-offset-2 hover:underline" href="{{ route('password.request') }}">
                    {{ __('strings.forgot password') }}
                </a>
            @endif

            <x-primary-button class="sm:ml-auto">
                {{ __('strings.log in button') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
