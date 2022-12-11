<?php

?>
<x-admin-layout>
    <x-slot name="header_slot">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('pages.admin.flags') }}
        </h2>
    </x-slot>
    <div class="pm-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
					<div class="card col-span-2 xl:col-span-1">
						<div class="card-header">{{ __('pages.admin.flags') }}</div>
                        <form
                            id="form_ff"
                            method="post"
                            action="{{ route('admin.flags.update') }}"
                        >
                            @csrf
                            @foreach ($flags as $k => $v)
                                <div style="padding:10px">
                                    <label for="FF_{{ $k }}">{{ $k }}</label>
                                    <input
                                        id="FF_{{ $k }}"
                                        class="chk-ff-item"
                                        type="checkbox"
                                        onchange="onCheckboxChangeFF(this)"
                                        @if ($v)
                                            checked
                                        @endif
                                    >
                                    <input type="hidden" name="{{ $k }}" value="{{ $v ? '1' : '0' }}" data-id="FF_{{ $k }}">
                                </div>
                            @endforeach
                            <div class="p-4">
                                <input type="submit" class="btn-bs-primary" value="Update">
                            </div>
                        </form>
					</div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
<script>
function onCheckboxChangeFF(el) {
    var v = el.checked;
    var id = el.getAttribute('id');
    document.querySelector('[data-id="' + id + '"]').value = v ? '1' : '0';
}
</script>
