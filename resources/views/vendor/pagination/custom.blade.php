@if ($paginator->hasPages())
<nav style="display:flex; justify-content:center; align-items:center; gap:6px; flex-wrap:wrap; margin-top:32px;">

    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <span style="display:inline-flex;align-items:center;gap:6px;padding:8px 18px;border-radius:50px;border:1px solid #e2e8f0;color:#94a3b8;font-size:0.9rem;font-weight:600;cursor:not-allowed;background:#f8fafc;">
            <i class="fas fa-chevron-left" style="font-size:0.75rem;"></i> Sebelumnya
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" style="display:inline-flex;align-items:center;gap:6px;padding:8px 18px;border-radius:50px;border:1px solid #cbd5e1;color:#1a6fc4;font-size:0.9rem;font-weight:600;text-decoration:none;transition:all 0.2s;background:#fff;" onmouseover="this.style.background='#1a6fc4';this.style.color='#fff';this.style.borderColor='#1a6fc4';" onmouseout="this.style.background='#fff';this.style.color='#1a6fc4';this.style.borderColor='#cbd5e1';">
            <i class="fas fa-chevron-left" style="font-size:0.75rem;"></i> Sebelumnya
        </a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <span style="display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;border-radius:50%;color:#94a3b8;font-weight:700;font-size:0.95rem;">{{ $element }}</span>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span style="display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;border-radius:50%;background:#1a6fc4;color:#fff;font-weight:700;font-size:0.95rem;box-shadow:0 2px 8px rgba(26,111,196,0.35);">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" style="display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;border-radius:50%;border:1px solid #e2e8f0;color:#475569;font-weight:600;font-size:0.95rem;text-decoration:none;transition:all 0.2s;background:#fff;" onmouseover="this.style.background='#1a6fc4';this.style.color='#fff';this.style.borderColor='#1a6fc4';" onmouseout="this.style.background='#fff';this.style.color='#475569';this.style.borderColor='#e2e8f0';">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" style="display:inline-flex;align-items:center;gap:6px;padding:8px 18px;border-radius:50px;border:1px solid #cbd5e1;color:#1a6fc4;font-size:0.9rem;font-weight:600;text-decoration:none;transition:all 0.2s;background:#fff;" onmouseover="this.style.background='#1a6fc4';this.style.color='#fff';this.style.borderColor='#1a6fc4';" onmouseout="this.style.background='#fff';this.style.color='#1a6fc4';this.style.borderColor='#cbd5e1';">
            Selanjutnya <i class="fas fa-chevron-right" style="font-size:0.75rem;"></i>
        </a>
    @else
        <span style="display:inline-flex;align-items:center;gap:6px;padding:8px 18px;border-radius:50px;border:1px solid #e2e8f0;color:#94a3b8;font-size:0.9rem;font-weight:600;cursor:not-allowed;background:#f8fafc;">
            Selanjutnya <i class="fas fa-chevron-right" style="font-size:0.75rem;"></i>
        </span>
    @endif

</nav>

<p style="text-align:center;margin-top:12px;font-size:0.85rem;color:#94a3b8;">
    Menampilkan {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} dari {{ $paginator->total() }} hasil
</p>
@endif
