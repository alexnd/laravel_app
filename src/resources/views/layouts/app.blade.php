<?php
    $header_slot_html = $header ?? config('app.name') ?? 'LaravelApp';
    $default_slot_html = $slot ?? '';
    $is_navigation_visible = $nav ?? false;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'LaravelApp') }}</title>
<!-- Fonts -->
<link rel="stylesheet" href="//fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="min-h-screen bg-gray-100 font-sans antialiased">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <!-- Page Heading -->
        @if (!empty($header_slot_html))
        <header class="max-w-7xl mx-auto px-4 mt-8">
            <h1 class="text-3xl text-black bold text-center">{{ $header_slot_html }}</h1>
        </header>
        @endif
        <!-- Navigation Bar -->
        @if ($is_navigation_visible)
        @include('includes.navigation')
        @endif
        <!-- Page Content -->
        @if (!empty($default_slot_html))
        <main class="mt-8 bg-white overflow-hidden shadow sm:rounded-lg">
            <div class="p-8">
                {{ $default_slot_html }}
            </div>
        </main>
        @endif
        @auth
        <form method="POST" action="{{ route('logout') }}" id="form_logout">@csrf</form>
        @endauth
    </div>
@include('includes.scripts')
</body>
</html>
