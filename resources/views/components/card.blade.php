{{-- 
  Card — primary content container.
  
  Usage 1 — body-only:
    <x-card>
        Isi card di sini
    </x-card>

  Usage 2 — dengan title:
    <x-card title="Statistik Bulan Ini">
        Isi card
    </x-card>

  Usage 3 — dengan title + action di header (slot 'header-action'):
    <x-card title="Pengguna Terbaru">
        <x-slot:headerAction>
            <x-button variant="ghost" size="sm">Lihat semua</x-button>
        </x-slot:headerAction>
        Isi card
    </x-card>

  Usage 4 — fully custom header (slot 'header'):
    <x-card>
        <x-slot:header>
            <div>Custom header markup</div>
        </x-slot:header>
        Isi card
    </x-card>

  Props:
    title    : string → render sebagai .card-title di header
    noBody   : true   → skip .card-body wrapper (kalau mau struktur custom)
--}}
@props([
    'title'   => null,
    'noBody'  => false,
])

<div {{ $attributes->merge(['class' => 'card']) }}>

    {{-- Header: full slot atau title+action pattern --}}
    @if (isset($header))
        <div class="card-header">{{ $header }}</div>
    @elseif ($title)
        <div class="card-header">
            <div class="card-title">{{ $title }}</div>
            @isset($headerAction)
                <div>{{ $headerAction }}</div>
            @endisset
        </div>
    @endif

    {{-- Body --}}
    @if ($noBody)
        {{ $slot }}
    @else
        <div class="card-body">{{ $slot }}</div>
    @endif

</div>