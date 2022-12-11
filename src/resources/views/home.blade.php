<?php
use App\Enums\UserRolesEnum;

$user = Auth::user() ?? null;
$user_role = $user->role_id ?? UserRolesEnum::GUEST;
$user_name = $user->name ?? __('guest');
$error_message = $error ?? '';
$flash_message = $message ?? '';
$input_username = $old_username ?? '';
$input_phone = $old_phone ?? '';
?>
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-center pt-8 sm:justify-start sm:pt-0">
            <a href="/" class="block">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
            <a href="/" class="flex justify-center items-center">
                <h1 class="text-3xl ml-3">{{ env('APP_NAME') }}</h1>
            </a>
            @if ($user_role === UserRolesEnum::ADMIN)
                <a href="{{ route('admin') }}" class="btn-dark ml-4 mt-4 h-10">Admin panel</a>
            @endif
        </div>
    </x-slot>
    <div class="mx-auto max-w-2xl">
        @if (!empty($error_message))
            <div class="mb-4">
                <h1 class="text-2xl text-red-600 bold">{{ $error_message }}</h1>
            </div>
        @endif
        @if (isset($errors) && $errors->any())
            <ul class="block text-2xl text-red-600 bold mb-4">
            @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
            </ul>
        @endif
        @if (!empty($flash_message))
            <div class="mb-4">
                <p class="text-l text-green-600 inline py-2 px-4 border rounded-lg bg-gray-100">{{ $flash_message }}</p>
            </div>
        @endif
        <form method="POST" action="{{ route('creategame') }}" style="display:block;max-width:420px">
            @csrf
            <div class="mb-4">
                <label for="username" class="label">{{ __('username') }}</label>
                <input type="text" id="username" name="username" class="input" value="{{ $input_username }}">
            </div>
            <div class="mb-4">
                <label for="phone" class="label">{{ __('phone') }}</label>
                <input type="text" id="phone" name="phone" class="input" value="{{ $input_phone }}">
            </div>
            <div>
                <input type="submit" class="btn-green" value="{{ __('auth.login.register') }}">
            </div>
        </form>
    </div>
</x-app-layout>
