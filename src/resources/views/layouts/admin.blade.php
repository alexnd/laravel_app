<?php
use App\Enums\UserRolesEnum;
$user = Auth::user() ?? null;
$user_role = $user->role_id ?? UserRolesEnum::GUEST;
$user_name = $user->name ?? 'Guest' ?? 'Guest';
$routeAction = Route::currentRouteAction();
$is_admin_route = (strpos($routeAction, 'AdminController') !== false);
$flash_message = \Session::get('message') ?? '';
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="debug:route" content="{{ Route::currentRouteName() }}">
<meta name="debug:route-action" content="{{ $routeAction }}">
<link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<title>{{ config('app.name', 'LaravelApp') }}</title>
<script src="/js/scripts.js"></script>
</head>
<body class="bg-gray-100">
<!-- start navbar -->
<div class="md:fixed md:w-full md:top-0 md:z-20 flex flex-row flex-wrap items-center bg-white p-6 border-b border-gray-300">
    <!-- logo -->
    <div class="flex-none w-56 flex flex-row items-center">
        <a href="{{ route('home') }}">
            <img src="/img/logo.png" class="w-10 flex-none">
            <strong class="capitalize ml-1 flex-1">{{ env('APP_NAME') }}</strong>
        </a>
        <button id="sliderBtn" class="flex-none text-right text-gray-900 hidden md:block">
            <i class="fad fa-list-ul"></i>
        </button>
    </div>
    <!-- end logo -->
    <!-- navbar content toggle -->
    <button id="navbarToggle" class="hidden md:block md:fixed right-0 mr-6">
        <i class="fad fa-chevron-double-down"></i>
    </button>
    <!-- end navbar content toggle -->
    <!-- navbar content -->
    <div id="navbar" class="animated md:hidden md:fixed md:top-0 md:w-full md:left-0 md:mt-16 md:border-t md:border-b md:border-gray-200 md:p-10 md:bg-white flex-1 pl-3 flex flex-row flex-wrap justify-between items-center md:flex-col md:items-center">
        <!-- left -->
        <div class="text-gray-600 md:w-full md:flex md:flex-row md:justify-evenly md:pb-10 md:mb-10 md:border-b md:border-gray-200">
            @include('includes.header_navigation')
            @if (isset($header_slot) & !empty($header_slot))
            {{ $header_slot }}
            @endif
        </div>
        <!-- end left -->
        <!-- right -->
        <div class="flex flex-row-reverse items-center">
            <!-- user -->
            <div class="dropdown relative md:static">
                <button class="menu-btn focus:outline-none focus:shadow-outline flex flex-wrap items-center">
                    <div class="w-8 h-8 overflow-hidden rounded-full">
                        <img class="w-full h-full object-cover" src="/img/user.svg" >
                    </div>
                    <div class="ml-2 capitalize flex ">
                        <h1 class="text-sm text-gray-800 font-semibold m-0 p-0 leading-none">{{ $user_name }}</h1>
                        <i class="fad fa-chevron-down ml-2 text-xs leading-none"></i>
                    </div>
                </button>
                <button class="hidden fixed top-0 left-0 z-10 w-full h-full menu-overflow"></button>
                <div class="text-gray-500 menu hidden md:mt-10 md:w-full rounded bg-white shadow-md absolute z-20 right-0 w-40 mt-5 py-2 animated faster">
                    @include('includes.header_dropdown_menu')
                </div>
            </div>
            <!-- end user -->
            {{-- @include('includes.header_notifications') --}}
            {{-- @include('includes.header_messages') --}}
        </div>
        <!-- end right -->
    </div>
    <!-- end navbar content -->
</div>
<!-- end navbar -->
<!-- start wrapper -->
<div class="h-screen flex flex-row flex-wrap">
    <!-- start sidebar -->
    <div id="sideBar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">
        <!-- sidebar content -->
        <div class="flex flex-col">
            <!-- sidebar toggle -->
            <div class="text-right hidden md:block mb-4">
                <button id="sideBarHideBtn">
                    <i class="fad fa-times-circle"></i>
                </button>
            </div>
            <!-- end sidebar toggle -->
            @if (isset($sidebar_slot) && !empty($sidebar_slot))
                {{ $sidebar_slot }}
            @endif
            @if ($is_admin_route)
                @include('includes.sidebar_admin_menu')
            @endif
        </div>
        <!-- end sidebar content -->
    </div>
    <!-- end sidebar -->
<!-- start content -->
<div class="bg-gray-100 flex-1 p-6 md:mt-16">
@if (!empty($flash_message))
    <div class="mb-4">
        <p class="text-l text-green-600 inline py-2 px-4 border rounded-lg bg-gray-100">{{ $flash_message }}</p>
    </div>
@endif
{{ $slot }}
</div>
<!-- end content -->
</div>
<!-- end wrapper -->
</body>
</html>
