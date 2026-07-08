<x-guest-layout>
    <div class="mb-6">
        <h1 class="auth-title">
            <a href="{{ route('home') }}" class="transition hover:text-blue-600">
                {{ __('strings.task manager') }}
            </a>
        </h1>
        <p class="auth-subtitle">{{ __('strings.registration') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5" novalidate>
        @csrf

        <div>
            <x-input-label for="name" :value="__('strings.name')" class="form-label" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="form-error" />
        </div>

        <div>
            <x-input-label for="email" :value="__('strings.email')" class="form-label" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="form-error" />
        </div>

        <div>
            <x-input-label for="password" :value="__('strings.password')" class="form-label" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="form-error" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('strings.confirmation')" class="form-label" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="form-error" />
        </div>

        <div class="flex flex-col gap-4 pt-2 sm:flex-row sm:items-center sm:justify-between">
            <a class="btn-secondary underline-offset-2 hover:underline" href="{{ route('login') }}">
                {{ __('strings.already registered') }}
            </a>

            <x-primary-button class="sm:ml-auto">
                {{ __('strings.register button') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
