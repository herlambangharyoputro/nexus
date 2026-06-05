{{-- 
  Avatar — circular user identifier.

  Usage 1 — initials (manual):
    <x-avatar initials="AP" />
    <x-avatar initials="JD" size="lg" />

  Usage 2 — auto-initials dari nama:
    <x-avatar name="Andi Pratama" />          → "AP"
    <x-avatar name="John" />                  → "J"

  Usage 3 — image:
    <x-avatar src="{{ asset('avatars/user1.jpg') }}" name="User 1" />

  Usage 4 — custom background color via inline style:
    <x-avatar initials="AB" style="background: var(--green);" />

  Props:
    size     : md (default) | sm | lg
    initials : 1-2 letter override
    name     : string → kalau initials kosong, auto-generate dari nama
    src      : URL gambar → kalau diisi, render <img> di dalam avatar
--}}
@props([
    'size'     => 'md',
    'initials' => null,
    'name'     => null,
    'src'      => null,
])

@php
    // Auto-generate initials kalau ada $name
    if (! $initials && $name) {
        $parts = explode(' ', trim($name));
        $initials = strtoupper(
            count($parts) >= 2
                ? substr($parts[0], 0, 1) . substr(end($parts), 0, 1)
                : substr($parts[0], 0, 2)
        );
    }

    $classes = ['avatar'];
    if ($size === 'sm') $classes[] = 'avatar-sm';
    if ($size === 'lg') $classes[] = 'avatar-lg';
    $classAttr = implode(' ', $classes);
@endphp

<div {{ $attributes->merge(['class' => $classAttr]) }} 
     @if ($name) title="{{ $name }}" @endif>
    @if ($src)
        <img src="{{ $src }}" alt="{{ $name ?? 'Avatar' }}" 
             style="width:100%;height:100%;object-fit:cover;border-radius:inherit;">
    @else
        {{ $initials ?? '?' }}
    @endif
</div>