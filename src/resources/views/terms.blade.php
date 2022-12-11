<?php
$html = new DOMDocument();
$html->preserveWhiteSpace = false;
$html->strictErrorChecking = false;
$html->loadHTMLFile(resource_path('data/terms.html'));
$content = '';
$body_nodes = $html->getElementsByTagName('body')->item(0)->childNodes;
foreach ($body_nodes as $node) {
    $content .= $html->saveHTML($node);
}
?>
<x-guest-layout>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {!! $content !!}
        </div>
        <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
            <div class="text-center text-sm text-gray-500 sm:text-left">
                <div class="flex items-center">
                    <a
                        href="{{ route('home') }}"
                        class="ml-4 underline"
                    >
                        {{ __('pages.home') }}
                    </a>
                </div>
            </div>
            <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                {!! __('copyright') !!}
            </div>
        </div>
    </div>
</x-guest-layout>
