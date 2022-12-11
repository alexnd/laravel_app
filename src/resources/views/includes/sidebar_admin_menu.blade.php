<?php
$adminMenu = [
    [
        'name' => __('admin.title.general'),
        'items' => [
            [
                'name' => __('pages.admin'),
                'url' => route('admin'),
                'route' => 'admin',
                'icon' => 'fa-computer-classic'
            ],
            [
                'name' => __('pages.admin.flags'),
                'url' => route('admin.flags'),
                'route' => 'admin.flags',
                'icon' => 'fa-box-open'
            ],
        ],
    ],
    [
        'name' => __('admin.title.users'),
        'items' => [
            [
                'name' => __('pages.admin.gameplayers'),
                'url' => route('admin.gameplayers'),
                'route' => 'admin.users',
                'icon' => 'fa-chart-pie'
            ],
            [
                'name' => __('pages.admin.users'),
                'url' => route('admin.users'),
                'route' => 'admin.users',
                'icon' => 'fa-box-open'
            ]
        ]
    ],
];
?>

@foreach ($adminMenu as $menuGroup)
    <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider">{{ $menuGroup['name'] }}</p>
    @foreach ($menuGroup['items'] as $item)
    <a
        href="{{ $item['url'] }}"
        class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500"
    >
        <i class="fad {{ $item['icon'] }} text-xs mr-2"></i>
        {{ $item['name'] }}
    </a>
    @endforeach
@endforeach
