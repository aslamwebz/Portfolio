@php
    $state = $getState();
@endphp

@if ($state)
    <img src="{{ $state }}" style="height: auto; width: 100%;" class="max-w-none object-cover object-center ring-white dark:ring-gray-900">
@endif
