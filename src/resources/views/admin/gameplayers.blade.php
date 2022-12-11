<x-admin-layout>
    <x-slot name="header_slot">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('pages.admin.gameplayers') }}
        </h2>
    </x-slot>
    <div class="pm-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
					<div class="card col-span-2 xl:col-span-1">
						<div class="card-header">
                            {{ __('admin.title.users') }}
                            <a
                                href="{{ route('admin.gameplayers.add') }}"
                                class="ml-10"
                            ><i class="fad fa-plus"></i></a>
                        </div>
						<table class="table-auto w-full text-left">
							<thead>
								<tr>
									<th class="px-2 py-2 border-r">{{ __('admin.column.id') }}</th>
									<th class="px-4 py-2 border-r">{{ __('admin.column.username') }}</th>
									<th class="px-4 py-2 border-r">{{ __('admin.column.phone') }}</th>
									<th class="px-4 py-2 border-r">{{ __('admin.column.uri') }}</th>
									<th class="px-4 py-2 border-r">{{ __('admin.column.date') }}</th>
									<th class="px-2 py-2">{{ __('admin.column.actions') }}</th>
								</tr>
							</thead>
							<tbody class="text-gray-600">
							@foreach ($users as $item)
								<tr>
									<td class="border border-l-0 px-4 py-2">{{ $item['id'] }}</td>
									<td class="border border-l-0 px-4 py-2">{{ $item['username'] }}</td>
									<td class="border border-l-0 px-4 py-2">{{ $item['phone'] }}</td>
									<td class="border border-l-0 px-4 py-2">{{ $item['uri'] }}</td>
									<td class="border border-l-0 px-4 py-2">
										<span class="num-2">{{ date('Y-m-d', strtotime($item['created_at'])) }}</span>
										|
										<span class="num-2">{{ date('Y-m-d', strtotime($item['updated_at'])) }}</span>
									</td>
									<td class="border border-l-0 border-r-0 px-4 py-2 text-black-500">
                                        <a
                                            href="{{ route('admin.gameplayers.bids', $item['id']) }}"
                                            title="{{ __('admin.title.bids') }}"
                                        ><i class="fad fa-chart-pie"></i></a>
                                        <a
                                            href="{{ route('admin.gameplayers.edit', $item['id']) }}"
                                            title="{{ __('admin.action.edit_user') }}"
                                        ><i class="fad fa-edit mx-2"></i></a>
										<a
										    href="#"
										    title="{{ __('admin.action.delete_user') }}"
										    onclick="event.preventDefault();if(!confirm({{Js::from(__('admin.confirm.delete_user'))}})) return false;document.getElementById('formUserDeleteId').value='{{ $item['id'] }}';document.getElementById('formUserDelete').submit()"
										><i class="fad fa-trash"></i></a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
					<form
						method="POST"
						action="{{ route('admin.gameplayers.delete') }}"
						id="formUserDelete"
					>
						@csrf
						<input type="hidden" name="id" id="formUserDeleteId" value="">
					</form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

