@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-wrap items-center justify-center gap-2 my-8 font-display">
        
        {{-- First Page Link (<<) --}}
        @if ($paginator->onFirstPage())
            <span class="w-10 h-10 flex items-center justify-center rounded-full text-[var(--color-text-secondary)] bg-[var(--color-background)] border border-[var(--color-border)] cursor-not-allowed opacity-50">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/></svg>
            </span>
        @else
            <a href="{{ $paginator->url(1) }}" class="w-10 h-10 flex items-center justify-center rounded-full text-[var(--color-secondary)] bg-[var(--color-surface)] border border-[var(--color-border)] hover:bg-[#e3e8e0] hover:text-[var(--color-secondary)] transition shadow-sm" title="Halaman Pertama">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/></svg>
            </a>
        @endif

        {{-- Previous Page Link (<) --}}
        @if ($paginator->onFirstPage())
            <span class="w-10 h-10 flex items-center justify-center rounded-full text-[var(--color-text-secondary)] bg-[var(--color-background)] border border-[var(--color-border)] cursor-not-allowed opacity-50">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="w-10 h-10 flex items-center justify-center rounded-full text-[var(--color-secondary)] bg-[var(--color-surface)] border border-[var(--color-border)] hover:bg-[#e3e8e0] hover:text-[var(--color-secondary)] transition shadow-sm" title="Halaman Sebelumnya">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
        @endif

        {{-- Pagination Elements (Numbers) --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="w-10 h-10 flex items-center justify-center text-[var(--color-text-secondary)]">...</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="w-10 h-10 flex items-center justify-center rounded-full bg-[var(--color-secondary)] text-[var(--color-primary)] font-bold shadow-md transform scale-110">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-full text-[var(--color-text-secondary)] bg-[var(--color-surface)] border border-[var(--color-border)] hover:bg-[#e3e8e0] hover:text-[var(--color-secondary)] hover:font-bold transition shadow-sm">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link (>) --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="w-10 h-10 flex items-center justify-center rounded-full text-[var(--color-secondary)] bg-[var(--color-surface)] border border-[var(--color-border)] hover:bg-[#e3e8e0] hover:text-[var(--color-secondary)] transition shadow-sm" title="Halaman Selanjutnya">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        @else
            <span class="w-10 h-10 flex items-center justify-center rounded-full text-[var(--color-text-secondary)] bg-[var(--color-background)] border border-[var(--color-border)] cursor-not-allowed opacity-50">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </span>
        @endif

        {{-- Last Page Link (>>) --}}
        @if ($paginator->currentPage() == $paginator->lastPage())
            <span class="w-10 h-10 flex items-center justify-center rounded-full text-[var(--color-text-secondary)] bg-[var(--color-background)] border border-[var(--color-border)] cursor-not-allowed opacity-50">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/></svg>
            </span>
        @else
            <a href="{{ $paginator->url($paginator->lastPage()) }}" class="w-10 h-10 flex items-center justify-center rounded-full text-[var(--color-secondary)] bg-[var(--color-surface)] border border-[var(--color-border)] hover:bg-[#e3e8e0] hover:text-[var(--color-secondary)] transition shadow-sm" title="Halaman Terakhir">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/></svg>
            </a>
        @endif
    </nav>
@endif
