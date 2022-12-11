<?php
use App\Enums\UserRolesEnum;
$error_message = $error ?? '';
$input_name = $data['name'] ?? $name ?? '';
$input_email = $data['email'] ?? $email ?? '';
$input_token = $data['remember_token'] ?? $remember_token ?? '';
$role_id = $data['role_id'] ?? $role_id ?? 0;
?>
<x-admin-layout>
    <x-slot name="header_slot">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('admin.users') }}">{{ __('pages.admin.users') }}</a>
            |
            {{ __('admin.action.edit_user') }}
        </h2>
    </x-slot>
    <div class="pm-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="card col-span-2 xl:col-span-1">
                        <div class="card-header">ID: {{ $id }}</div>
                        <form
                        method="POST"
                        action="{{ route('admin.users.update') }}"
                        id="form"
                    >
                        <div class="mb-4 ml-2 mt-2">
                            <label for="name" class="label">{{ __('name') }}</label>
                            <input
                                type="text" id="name" name="name"
                                value="{{ $input_name }}"
                                class="ml-4 rounded-md border px-2 py-1 w-6/12"
                            >
                        </div>
                        <div class="mb-4 ml-2">
                            <label for="email" class="label">{{ __('email') }}</label>
                            <input
                                type="text" id="email" name="email"
                                value="{{ $input_email }}"
                                class="ml-4 rounded-md border px-2 py-1 w-6/12"
                            >
                        </div>
                        <div class="mb-4 ml-2">
                            <label for="remember_token" class="label">Remember Token</label>
                            <input
                                type="text" id="remember_token" name="remember_token"
                                value="{{ $input_token }}"
                                class="ml-4 rounded-md border px-2 py-1 w-6/12"
                            >
                        </div>
                        <div class="mb-4 ml-2">
                            <label for="role_id" class="label">Role</label>
                            <select name="role_id" id="role_id" class="ml-4 rounded-md border px-2 py-1 w-6/12">
                                @foreach( UserRolesEnum::getDictionary() as $roleId => $roleName)
                                    <option
                                        @if ($role_id == $roleId)
                                        selected
                                        @endif
                                        value="{{ $roleId }}"
                                    >{{ $roleName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="p-2">
                            <input type="submit" class="btn btn-bs-primary" value="{{ __('update') }}">
                        </div>
                        @csrf
                        <input type="hidden" name="id" value="{{ $id ?? '' }}">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
