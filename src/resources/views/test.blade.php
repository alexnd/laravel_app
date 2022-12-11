<?php
$uid = $uri ?? gen_uuid();
?>
<x-guest-layout>

    <x-slot name="header">
        [Test template]
    </x-slot>

    <div class="mt-8 bg-white overflow-hidden shadow sm:rounded-lg">

        <p>UUID: {{ $uid }}</p>

        <hr>

        <div class="flex flex-col gap-1">
            <button class="px-6 py-2 rounded bg-slate-400 hover:bg-slate-500 text-slate-100">Button</button>
            <button class="px-6 py-2 rounded bg-zinc-400 hover:bg-zinc-500 text-zinc-100">Button</button>
            <button class="px-6 py-2 rounded bg-neutral-400 hover:bg-neutral-500 text-neutral-100">Button</button>
            <button class="px-6 py-2 rounded bg-stone-400 hover:bg-stone-500 text-stone-100">Button</button>
            <button class="px-6 py-2 text-orange-100 bg-orange-400 rounded hover:bg-orange-500">Button</button>
            <button class="px-6 py-2 rounded bg-amber-400 hover:bg-amber-500 text-amber-100">Button</button>
            <button class="px-6 py-2 rounded bg-lime-400 hover:bg-lime-500 text-lime-100">Button</button>
            <button class="px-6 py-2 rounded bg-emerald-400 hover:bg-emerald-500 text-emerald-100">Button</button>
            <button class="px-6 py-2 text-teal-100 bg-teal-400 rounded hover:bg-teal-500">Button</button>
            <button class="px-6 py-2 rounded bg-cyan-400 hover:bg-cyan-500 text-cyan-100">Button</button>
            <button class="px-6 py-2 rounded bg-sky-400 hover:bg-sky-500 text-sky-100">Button</button>
            <button class="px-6 py-2 rounded bg-violet-400 hover:bg-violet-500 text-violet-100">Button</button>
            <button class="px-6 py-2 text-purple-100 bg-purple-400 rounded hover:bg-purple-500">Button</button>
            <button class="px-6 py-2 rounded bg-fuchsia-400 hover:bg-fuchsia-500 text-fuchsia-100">Button</button>
            <button class="px-6 py-2 rounded bg-rose-400 hover:bg-rose-500 text-rose-100">Button</button>
        </div>
    </div>

    <div x-data="{ open: false }">
        <!-- Button -->
        <button x-on:click="open = true" type="button" class="bg-white border border-black px-4 py-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
            Open dialog
        </button>

        <!-- Modal -->
        <div
            x-show="open"
            x-on:keydown.escape.prevent.stop="open = false"
            role="dialog"
            aria-modal="true"
            x-id="['modal-title']"
            :aria-labelledby="$id('modal-title')"
            class="fixed inset-0 overflow-y-auto"
        >
            <!-- Overlay -->
            <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

            <!-- Panel -->
            <div
                x-show="open" x-transition
                x-on:click="open = false"
                class="relative min-h-screen flex items-center justify-center p-4"
            >
                <div
                    x-on:click.stop
                    x-trap.noscroll.inert="open"
                    class="relative max-w-2xl w-full bg-white border border-black p-8 overflow-y-auto"
                >
                    <p>{{ $uid }}</p>
                    <!-- Title -->
                    <h2 class="text-3xl font-medium" :id="$id('modal-title')">Confirm</h2>
                    <!-- Content -->
                    <p class="mt-2 text-gray-600">Are you sure you want to learn how to create an awesome modal?</p>
                    <!-- Buttons -->
                    <div class="mt-8 flex space-x-2">
                        <button type="button" x-on:click="open = false" class="bg-white border border-black px-4 py-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                            Confirm
                        </button>
                        <button type="button" x-on:click="open = false" class="bg-white border border-black px-4 py-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
