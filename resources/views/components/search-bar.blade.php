@props([
    'placeholder' => 'Cari...',
    'value' => '',
    'size' => 'normal', // 'normal' or 'large'
])

@php
    $containerClass = $size === 'large' 
        ? 'flex shadow-sm rounded-full overflow-hidden border border-[var(--color-border)] bg-[var(--color-surface)] items-center pr-2 focus-within:border-[var(--color-accent)] focus-within:ring-2 focus-within:ring-[var(--color-accent)]/20 transition-all'
        : 'flex shadow-sm rounded-full overflow-hidden border border-[var(--color-border)] bg-[var(--color-surface)] items-center pr-1.5 focus-within:border-[var(--color-accent)] focus-within:ring-2 focus-within:ring-[var(--color-accent)]/20 transition-all';

    $inputClass = $size === 'large'
        ? 'w-full px-8 py-5 text-[var(--color-text-primary)] focus:outline-none bg-transparent font-display text-lg'
        : 'w-full px-6 py-3.5 text-[var(--color-text-primary)] focus:outline-none bg-transparent font-display text-sm placeholder-gray-400';

    $buttonClass = $size === 'large'
        ? 'bg-[var(--color-secondary)] text-[var(--color-primary)] w-14 h-14 rounded-full flex items-center justify-center hover:bg-[var(--color-accent)] transition shrink-0 shadow-sm mr-1'
        : 'bg-[var(--color-secondary)] text-[var(--color-primary)] w-10 h-10 rounded-full flex items-center justify-center hover:bg-[var(--color-accent)] transition shrink-0 shadow-sm mr-1';

    $iconClass = $size === 'large' ? 'w-6 h-6' : 'w-5 h-5';
@endphp

<div class="{{ $containerClass }}">
    <input type="text" name="q" value="{{ $value }}" placeholder="{{ $placeholder }}" class="{{ $inputClass }}">
    <button type="submit" class="{{ $buttonClass }}" aria-label="Cari">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="{{ $iconClass }}">
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>
    </button>
</div>
