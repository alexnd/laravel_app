<?php
$error_message = $error ?? '';
$input_username = $username ?? '';
$input_phone = $phone ?? '';
$input_uri = $uri ?? '';
?>
<x-admin-layout>
    <x-slot name="header_slot">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('admin.gameplayers') }}">{{ __('pages.admin.gameplayers') }}</a>
            |
            {{ __('admin.action.add_user') }}
        </h2>
    </x-slot>
    <div class="pm-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form
                        method="POST"
                        action="{{ route('admin.gameplayers.create') }}"
                        id="form"
                    >
                        <div class="mb-4">
                            <label for="username" class="label">{{ __('username') }}</label>
                            <input
                                type="text" id="username" name="username"
                                value="{{ $input_username }}"
                                class="ml-4 rounded-md border px-2 py-1 w-6/12"
                            >
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="label">{{ __('phone') }}</label>
                            <input
                                type="text" id="phone" name="phone"
                                value="{{ $input_phone }}"
                                class="ml-4 rounded-md border px-2 py-1 w-6/12"
                            >
                        </div>
                        <div class="mb-4">
                            <label
                                for="uri" class="label">{{ __('admin.column.uri') }}</label>
                            <input
                                type="text" id="uri" name="uri"
                                value="{{ $input_uri }}"
                                class="ml-4 rounded-md border px-2 py-1 w-6/12"
                            >
                        </div>
                        <div>
                            <input type="submit" class="btn btn-bs-primary" value="{{ __('create') }}">
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
