@extends('layouts.main')

@section('content')
    <div class="page-card">
        <div class="max-w-2xl">
            <p class="mb-2 text-sm font-medium uppercase tracking-wide text-blue-600">
                Laravel
            </p>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                Привет от Хекслета!
            </h1>
            <p class="mt-4 text-lg text-slate-600">
                Это простой менеджер задач на Laravel
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                @guest
                    <a href="{{ route('register') }}" class="btn-primary">
                        {{ __('strings.registration') }}
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                        {{ __('strings.log in') }}
                    </a>
                @endguest
            </div>
        </div>
    </div>
@endsection
