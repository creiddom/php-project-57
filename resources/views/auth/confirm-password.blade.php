<x-guest-layout>
    <div class="mb-6">
        <h1 class="auth-title">
            <a href="{{ route('home') }}" class="transition hover:text-blue-600">
                {{ __('strings.task manager') }}
            </a>
        </h1>
        <p class="auth-subtitle">{{ __('Confirm Password') }}</p>
    </div>

    <p class="mb-4 text-sm text-slate-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </p>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5" novalidate>
        @csrf

        <div>
            <x-input-label for="password" :value="__('strings.password')" class="form-label" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="form-error" />
        </div>

        <div class="flex justify-end pt-2">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
