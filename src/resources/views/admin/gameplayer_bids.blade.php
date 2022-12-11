<?php
$error_message = $error ?? '';
$usernme = $player['username'] ?? 'Undefined';
?>
<x-admin-layout>
    <x-slot name="header_slot">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('admin.gameplayers') }}">{{ __('pages.admin.gameplayers') }}</a>
            |
            {{ __('admin.title.bids') }}
        </h2>
    </x-slot>
    <div class="pm-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="mb-4 text-xl bold">Player {{ $usernme }} bids</h1>
                    <table>
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="py-3 px-6">ID</th>
                                <th class="py-3 px-6">Status</th>
                                <th class="py-3 px-6">Value</th>
                                <th class="py-3 px-6">Prize</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($bids) && count($bids))
                                @foreach($bids as $bid)
                                <tr class="bg-white border-b">
                                    <td class="py-3 px-6">{{ $bid['id'] }}</td>
                                    <td class="py-3 px-6">{{ $bid['win'] ? 'Win' : 'Lose' }}</td>
                                    <td class="py-3 px-6">{{ $bid['value'] }}</td>
                                    <td class="py-3 px-6">{{ $bid['prize'] }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">No records</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <a href="{{ route('admin.gameplayers') }}" class="btn btn-bs-secondary w-40 mt-4">{{ __('back') }}</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
