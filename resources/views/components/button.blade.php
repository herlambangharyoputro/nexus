{{-- 
  Button — supports semua variant CSS template.
  
  Usage:
    <x-button>Default Primary</x-button>
    <x-button variant="outline" size="sm">Cancel</x-button>
    <x-button variant="danger" type="submit">Delete</x-button>
    <x-button variant="ghost" icon>
        @include('icons.menu')
    </x-button>
    <x-button full-width href="{{ url('/somewhere') }}">Sign In</x-button>

  Props:
    variant  : primary (default) | outline | ghost | danger | success | warning
    size     : md (default) | sm | lg
    icon     : true → jadi square icon button (.btn-icon)
    full-width: true → .btn-w-full
    type     : button (default) | submit | reset
    href     : kalau diisi, render <a> bukan <button>
--}}
@props([
    'variant'    => 'primary',
    'size'       => 'md',
    'icon'       => false,
    'fullWidth'  => false,
    'type'       => 'button',
    'href'       => null,
])

@php
    $classes = ['btn', 'btn-' . $variant];
    if ($size === 'sm') $classes[] = 'btn-sm';
    if ($size === 'lg') $classes[] = 'btn-lg';
    if ($icon)          $classes[] = 'btn-icon';
    if ($fullWidth)     $classes[] = 'btn-w-full';
    $classAttr = implode(' ', $classes);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classAttr]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classAttr]) }}>
        {{ $slot }}
    </button>
@endif