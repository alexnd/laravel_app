<?php
use App\Enums\UserRolesEnum;
$roles = UserRolesEnum::getDictionary();
?>
<x-admin-layout>
    <x-slot name="header_slot">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('pages.admin.users') }}
        </h2>
    </x-slot>
    <div class="pm-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
					<div class="card col-span-2 xl:col-span-1">
						<div class="card-header">{{ __('admin.title.users') }}</div>
                        <table class="table-auto w-full text-left">
                            <thead>
                            <tr>
                                <th class="px-2 py-2 border-r">{{ __('admin.column.id') }}</th>
                                <th class="px-4 py-2 border-r">{{ __('admin.column.email') }}</th>
                                <th class="px-4 py-2 border-r">{{ __('admin.column.name') }}</th>
                                <th class="px-4 py-2 border-r">{{ __('admin.column.role') }}</th>
                                <th class="px-4 py-2 border-r">{{ __('admin.column.date') }}</th>
                                <th class="px-2 py-2">{{ __('admin.column.status') }}</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-600">
                            @foreach ($users as $item)
                                    <?php
                                    $item_loginable = ($item['role_id'] != UserRolesEnum::GUEST);
                                    if ($item_loginable) {
                                        $color = 'green';
                                    } else {
                                        $color = 'red';
                                    }
                                    ?>
                                <tr>
                                    <td class="border border-l-0 px-4 py-2">{{ $item['id'] }}</td>
                                    <td class="border border-l-0 px-4 py-2">{{ $item['email'] }}</td>
                                    <td class="border border-l-0 px-4 py-2">{{ $item['name'] }}</td>
                                    <td class="border border-l-0 px-4 py-2">{{ $roles[$item['role_id']] }}</td>
                                    <td class="border border-l-0 px-4 py-2">
                                        <span class="num-2">{{ date('Y-m-d', strtotime($item['created_at'])) }}</span>
                                        |
                                        <span class="num-2">{{ date('Y-m-d', strtotime($item['updated_at'])) }}</span>
                                    </td>
                                    <td class="border border-l-0 border-r-0 px-4 py-2">
                                        <a
                                            href="#"
                                            title="{{ __('admin.action.reset_user') }}"
                                            onclick="event.preventDefault();if(!confirm({{Js::from(__('admin.confirm.reset_user'))}})) return false;document.getElementById('formUserResetId').value='{{ $item['id'] }}';document.getElementById('formUserReset').submit()"
                                        >
                                            <i class="fad fa-circle cursor-pointer text-{{ $color }} text-{{ $color }}-500"></i>
                                        </a>
                                        <a
                                            href="{{ route('admin.users.edit', ['id' => $item['id']]) }}"
                                            title="{{ __('admin.action.edit_user') }}"
                                        >
                                            <i class="fad fa-edit m-3"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
					</div>
					<form
						method="POST"
						action="{{ route('admin.users.reset') }}"
						id="formUserReset"
					>
						@csrf
						<input type="hidden" name="id" id="formUserResetId" value="">
					</form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
