<?php
?>

<!-- item -->
<a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
    <i class="fad fa-user-edit text-xs mr-1"></i>
    edit my profile
</a>
<!-- end item -->

<!-- item -->
<a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
    <i class="fad fa-inbox-in text-xs mr-1"></i>
    my inbox
</a>
<!-- end item -->

<!-- item -->
<a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
    <i class="fad fa-badge-check text-xs mr-1"></i>
    tasks
</a>
<!-- end item -->

<!-- item -->
<a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
    <i class="fad fa-comment-alt-dots text-xs mr-1"></i>
    chats
</a>
<!-- end item -->

<hr>
<form method="POST" action="{{ route('logout') }}">
@csrf
<!-- item -->
    <a
        class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out"
        :href="route('logout')"
        onclick="event.preventDefault();
                                                this.closest('form').submit();"
    >
        <i class="fad fa-user-times text-xs mr-1"></i>
        {{ __('auth.logout') }}
    </a>
    <!-- end item -->
</form>
