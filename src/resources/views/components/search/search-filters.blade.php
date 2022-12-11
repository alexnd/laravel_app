<?php
?>
<div id="search_filters" class="">
	<form
		method="GET"
		action="{{ route('search') }}"
	>
		@csrf
		<div class="mb-2">
            <label
				for="search_filter_name"
				class="block text-sm font-medium text-gray-700"
			>{{ __('search.filters.name') }}</label>
            <input
				type="text"
				name="name"
				id="search_filter_name"
				value=""
				placeholder=""
			>
        </div>
		<div class="mb-2">
			<label
				for="search_filter_price_min"
				class="block text-sm font-medium text-gray-700"
			>{{ __('search.filters.price_min') }}</label>
			<input
				type="text"
				name="price_min"
				id="search_filter_price_min"
				class="ml-2 inline"
				value=""
			>
		</div>
		<div class="mb-4">
		    <label
				for="search_filter_price_max"
				class="block text-sm font-medium text-gray-700"
			>{{ __('search.filters.price_max') }}</label>
			<input
				type="text"
				name="price_max"
				id="search_filter_price_max"
				class="ml-2 inline"
				value=""
			>
		</div>
		<div class="mb-2">
			<x-button class="ml-4">
				{{ __('search.filters.search') }}
			</x-button>
		</div>
	</form>
</div>

