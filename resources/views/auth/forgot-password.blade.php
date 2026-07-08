<x-guest-layout>
    <div class="mb-6">
        <h1 class="auth-title">
            <a href="{{ route('home') }}" class="transition hover:text-blue-600">
                {{ __('strings.task manager') }}
            </a>
        </h1>
        <p class="auth-subtitle">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5" novalidate>
        @csrf

        <div>
            <x-input-label for="email" :value="__('strings.email')" class="form-label" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="form-error" />
        </div>

        <div class="flex justify-end pt-2">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
