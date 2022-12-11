<x-admin-layout>
    <x-slot name="header_slot">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('pages.admin') }}
        </h2>
    </x-slot>
    <div class="pb-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
					<div class="grid grid-cols-5 gap-6 xl:grid-cols-2">
                        <div class="card mt-6">
                            <div class="card-body flex items-center">
                                <div class="px-3 py-2 rounded bg-green-600 text-white mr-3">
                                    <i class="fad fa-shopping-cart"></i>
                                </div>
                                <div class="flex flex-col">
                                    <h1 class="font-semibold">
                                        {{ __('admin.total_users') }} <span class="num-2">{{ $totalUsers }}</span>
                                    </h1>
                                </div>
                            </div>
                        </div>
						<div class="card mt-6">
							<div class="card-body flex items-center">
								<div class="px-3 py-2 rounded bg-indigo-600 text-white mr-3">
									<i class="fad fa-wallet"></i>
								</div>
								<div class="flex flex-col">
									<h1 class="font-semibold">
										{{ __('admin.total_bids') }} <span class="num-2">{{ $totalBids }}</span>
									</h1>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
