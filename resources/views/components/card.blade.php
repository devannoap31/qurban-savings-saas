@props(['class' => ''])

<div {{ $attributes->merge(['class' => "bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] p-[24px] transition-all duration-300 hover:shadow-lg $class"]) }}>
    {{ $slot }}
</div>
