@extends('layouts.main')

@section('content')
    <div class="flex flex-col items-start">
        <h1 class="home-hero-title">
            {{ __('strings.hello from Hexlet') }}
        </h1>

        <p class="home-hero-subtitle">
            {{ __('strings.this is a simple task manager on Laravel') }}
        </p>

        <a href="{{ route('tasks.index') }}" class="home-hero-button">
            {{ __('strings.push me') }}
        </a>
    </div>
@endsection
