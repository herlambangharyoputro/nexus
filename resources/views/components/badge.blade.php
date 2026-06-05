{{-- 
  Badge — small status/label pill.

  Usage:
    <x-badge>Default Blue</x-badge>
    <x-badge color="green">Active</x-badge>
    <x-badge color="red">Suspended</x-badge>
    <x-badge color="amber">Pending</x-badge>
    <x-badge color="purple">VIP</x-badge>

  Props:
    color : blue (default) | green | amber | red | purple
--}}
@props([
    'color' => 'blue',
])

@php
    $classes = 'badge badge-' . $color;
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>