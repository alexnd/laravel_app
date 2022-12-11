<?php
use App\Enums\UserRolesEnum;

$user = Auth::user() ?? null;
$user_role = $user->role_id ?? UserRolesEnum::GUEST;
$user_name = $user->name ?? __('guest');
?>
<x-guest-layout>
    @if (Route::has('login'))
{{--                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">--}}
{{--                    @auth--}}
{{--                        <a href="{{ url('/admin') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>--}}
{{--                    @else--}}
{{--                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>--}}
{{--                        @if (Route::has('register'))--}}
{{--                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>--}}
{{--                        @endif--}}
{{--                    @endauth--}}
{{--                </div>--}}
    @endif

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-row justify-center pt-8 sm:justify-start sm:pt-0">
            <a href="/" class="block">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
            <a href="/" class="flex justify-center items-center">
                <h1 class="text-3xl ml-3">{{ env('APP_NAME') }}</h1>
            </a>
        </div>
        <div class="p-6"></div>

        <div class="mt-8 bg-white overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="ml-4 text-lg leading-7 font-semibold">
                            <h3>{{ __('home.total_players') }} {{ $totalPlayers }} </h3>
                            <h3>{{ __('home.total_users') }} {{ $totalUsers }} </h3>
                        </div>
                    </div>
                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
test
                        </div>
                    </div>
                </div>

                {{--
                <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                    <div class="flex items-center">

                        <div class="ml-4 text-lg leading-7 font-semibold">
                            @auth
                                <x-linkbutton
                                    href="{{ route('profile') }}"
                                    class="text-gray-700 dark:text-gray-500"
                                >{{ __('auth.profile') }}</x-linkbutton>
                                <x-linkbutton
                                    href="{{ route('company') }}"
                                    class="text-gray-700 dark:text-gray-500"
                                >{{ __('pages.company') }}</x-linkbutton>
                                <x-linkbutton
                                    href="{{ route('company.add') }}"
                                    class="text-gray-700 dark:text-gray-500"
                                >{{ __('pages.company.add') }}</x-linkbutton>
                            @else
                                <x-linkbutton
                                    class="ml-3"
                                    href="{{ route('login') }}"
                                >
                                    {{ __('auth.login') }}
                                </x-linkbutton>
                                <x-linkbutton
                                    class="g-blue-600 hover:bg-green-700"
                                    href="{{ route('register') }}"
                                >
                                    {{ __('auth.login.register') }}
                                </x-linkbutton>

                            @endauth
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">

                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">

                        <div class="ml-4 text-lg leading-7 font-semibold">
                            @auth
                                <x-linkbutton
                                    href="{{ route('search') }}"
                                    class="text-gray-700 dark:text-gray-500"
                                >{{ __('pages.search') }}</x-linkbutton>
                                @if ($user_role == UserRolesEnum::ADMIN)
                                    <x-linkbutton
                                        href="{{ route('admin') }}"
                                        class="text-gray-700 dark:text-gray-500"
                                    >{{ __('pages.admin') }}</x-linkbutton>
                                @endif
                            @else
                            @endauth
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">

                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                    <div class="flex items-center">
                        <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">
                        @auth
                            {{ __('home.logged_in') }}
                            {{ $user_name }}
                        @endauth
                        </div>
                    </div>

                    <div class="ml-4">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            @auth
                                <x-linkbutton
                                    href="#logout"
                                    class="text-gray-700 dark:text-gray-500"
                                    onclick="event.preventDefault();document.getElementById('form_logout').submit()">{{ __('auth.logout') }}</x-linkbutton>
                            @else
                            @endauth
                        </div>
                    </div>
                </div>
                --}}
            </div>
        </div>
{{--
                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            <a
                                href="{{ route('terms') }}"
                                class="ml-4 underline"
                            >
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                                    <path d="M13.75 2H10.25C9.09205 2 8.13841 2.87472 8.01379 3.99944L6.25 4C5.00736 4 4 5.00736 4 6.25V19.75C4 20.9926 5.00736 22 6.25 22H17.75C18.9926 22 20 20.9926 20 19.75V6.25C20 5.00736 18.9926 4 17.75 4L15.9862 3.99944C15.8616 2.87472 14.9079 2 13.75 2ZM10.25 3.5H13.75C14.1642 3.5 14.5 3.83579 14.5 4.25C14.5 4.66421 14.1642 5 13.75 5H10.25C9.83579 5 9.5 4.66421 9.5 4.25C9.5 3.83579 9.83579 3.5 10.25 3.5ZM12.5 10.25C12.5 9.83579 12.8358 9.5 13.25 9.5H16.75C17.1642 9.5 17.5 9.83579 17.5 10.25C17.5 10.6642 17.1642 11 16.75 11H13.25C12.8358 11 12.5 10.6642 12.5 10.25ZM13.2501 15H16.7499C17.1642 15 17.4999 15.3358 17.4999 15.75C17.4999 16.1642 17.1642 16.5 16.7499 16.5H13.2501C12.8358 16.5 12.5001 16.1642 12.5001 15.75C12.5001 15.3358 12.8358 15 13.2501 15ZM10.7803 9.78033L8.78033 11.7803C8.48744 12.0732 8.01256 12.0732 7.71967 11.7803L6.71967 10.7803C6.42678 10.4874 6.42678 10.0126 6.71967 9.71967C7.01256 9.42678 7.48744 9.42678 7.78033 9.71967L8.25 10.1893L9.71967 8.71967C10.0126 8.42678 10.4874 8.42678 10.7803 8.71967C11.0732 9.01256 11.0732 9.48744 10.7803 9.78033ZM10.7803 14.2197C11.0732 14.5126 11.0732 14.9874 10.7803 15.2803L8.78033 17.2803C8.48744 17.5732 8.01256 17.5732 7.71967 17.2803L6.71967 16.2803C6.42678 15.9874 6.42678 15.5126 6.71967 15.2197C7.01256 14.9268 7.48744 14.9268 7.78033 15.2197L8.25 15.6893L9.71967 14.2197C10.0126 13.9268 10.4874 13.9268 10.7803 14.2197Z" fill="currentColor"></path>
                                </svg>
                                <span>{{ __('pages.terms') }}</span>
                            </a>
                            <a
                                href="{{ route('help') }}"
                                class="ml-4 underline"
                            >
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M5.933.87a2.89 2.89 0 0 1 4.134 0l.622.638.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636zM7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm1.602-2.027c-.05.386-.218.627-.554.627-.377 0-.585-.317-.585-.745v-.11c0-.727.307-1.208.926-1.641.614-.44.822-.762.822-1.325 0-.638-.42-1.084-1.03-1.084-.55 0-.916.323-1.074.914-.109.364-.292.51-.564.51C6.203 6.12 6 5.873 6 5.48c0-.251.045-.468.139-.69.307-.798 1.079-1.29 2.099-1.29 1.341 0 2.262.902 2.262 2.227 0 .896-.376 1.511-1.05 1.986-.648.445-.806.726-.846 1.26z"></path>
                                </svg>
                                <span>{{ __('pages.help') }}</span>
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        {!! __('copyright') !!}
                    </div>
                </div>
                --}}
        </div>
    </div>
</x-guest-layout>
