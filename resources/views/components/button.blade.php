@props(['type' => 'button', 'variant' => 'primary', 'class' => ''])

@php
    $baseClass = 'inline-flex items-center justify-center px-6 py-3 rounded-full font-display font-medium text-sm transition-all duration-300 transform hover:-translate-y-1 hover:shadow-md';
    
    $variants = [
        'primary' => 'bg-[var(--color-accent)] text-[var(--color-primary)] hover:bg-[#1a3423]',
        'secondary' => 'bg-[var(--color-secondary)] text-[var(--color-primary)] hover:bg-black',
        'outline' => 'border border-[var(--color-border)] text-[var(--color-text-primary)] hover:bg-[var(--color-background)]',
        'danger' => 'bg-[var(--color-error)] text-white hover:bg-red-700'
    ];
    
    $variantClass = $variants[$variant] ?? $variants['primary'];
@endphp

@if($attributes->has('href'))
    <a {{ $attributes->merge(['class' => "$baseClass $variantClass $class"]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => "$baseClass $variantClass $class"]) }}>
        {{ $slot }}
    </button>
@endif
