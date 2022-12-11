<?php
?>
@props(['products','page','pages'])
<div class="card">
    <div class="card-body">
        <div class="flex flex-row justify-between items-center">
            <h1 class="font-extrabold text-lg">{{ __('search.title') }}</h1>
            <a href="#" class="btn-gray text-sm">{{ __('search.export') }}</a>
        </div>
        <table class="table-auto w-full mt-5 text-right">
            <thead>
            <tr>
                <td class="py-2 font-extrabold text-sm text-left">{{ __('search.column.id') }}</td>
                <td class="py-2 font-extrabold text-sm">{{ __('search.column.model') }}</td>
                <td class="py-5 font-extrabold text-sm text-left">{{ __('search.column.name') }}</td>
                <td class="py-5 font-extrabold text-sm">{{ __('search.column.category') }}</td>
				<td class="py-2 font-extrabold text-sm">{{ __('search.column.price') }}</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $item)
                <tr class="">
                    <td class="py-2 text-xs text-gray-600 text-left">
                        #{{ $item->id }} {{ $item->sku }}
                    </td>
                    <td class="py-2 text-xs text-gray-600 text-left">
                        <span class="num-3">{{ $item->model }}</span>
                    </td>
                    <td class="py-5 text-sm text-gray-600 flex flex-row items-center text-left">
                        @if ($item->images)
                            <div class="w-8 h-8 overflow-hidden mr-3">
                                <img src="{{ $item->images }}" class="object-cover">
                            </div>
                        @endif
                        {{ $item->name}}
                    </td>
                    <td class="py-5 text-xs text-gray-600">{{ $item->category }}</td>
					<td class="py-2 text-xs text-gray-600">
                        $ <span class="num-4">{{ number_format($item->price, 2) }}</span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="card-footer flex justify-between">
            <p>
			@if ($page > 1)
			<a href="?page={{ $page-1 }}">{{ __('pagination.prev') }}</a>
			@else
			&nbsp;
			@endif
			</p>
            {{ $slot }}
            <p>
			@if ($page < $pages)
			<a href="?page={{ $page+1 }}">{{ __('pagination.next') }}</a>
			@else
			&nbsp;
			@endif
			</p>
        </div>
		<div>
		
		</div>
    </div>
</div>
