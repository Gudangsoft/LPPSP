@if ($paginator->hasPages())
<div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-top:16px; padding-top:16px; border-top:1px solid #e2e8f0;">

    <p style="margin:0; font-size:0.85rem; color:#64748b;">
        Menampilkan <strong>{{ $paginator->firstItem() }}</strong>–<strong>{{ $paginator->lastItem() }}</strong>
        dari <strong>{{ $paginator->total() }}</strong> data
    </p>

    <nav style="display:flex; align-items:center; gap:4px; flex-wrap:wrap;">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span style="display:inline-flex;align-items:center;gap:4px;padding:6px 14px;border-radius:6px;border:1px solid #e2e8f0;color:#cbd5e1;font-size:0.85rem;font-weight:600;cursor:not-allowed;background:#f8fafc;">
                <i class="fas fa-chevron-left" style="font-size:0.7rem;"></i> Sebelumnya
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" style="display:inline-flex;align-items:center;gap:4px;padding:6px 14px;border-radius:6px;border:1px solid #e2e8f0;color:#475569;font-size:0.85rem;font-weight:600;text-decoration:none;background:#fff;transition:all 0.15s;" onmouseover="this.style.borderColor='#1a6fc4';this.style.color='#1a6fc4';" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#475569';">
                <i class="fas fa-chevron-left" style="font-size:0.7rem;"></i> Sebelumnya
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span style="padding:6px 10px;color:#94a3b8;font-size:0.85rem;">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="display:inline-flex;align-items:center;justify-content:center;min-width:34px;height:34px;padding:0 8px;border-radius:6px;background:#1a6fc4;color:#fff;font-weight:700;font-size:0.85rem;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="display:inline-flex;align-items:center;justify-content:center;min-width:34px;height:34px;padding:0 8px;border-radius:6px;border:1px solid #e2e8f0;color:#475569;font-weight:600;font-size:0.85rem;text-decoration:none;background:#fff;transition:all 0.15s;" onmouseover="this.style.borderColor='#1a6fc4';this.style.color='#1a6fc4';" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#475569';">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" style="display:inline-flex;align-items:center;gap:4px;padding:6px 14px;border-radius:6px;border:1px solid #e2e8f0;color:#475569;font-size:0.85rem;font-weight:600;text-decoration:none;background:#fff;transition:all 0.15s;" onmouseover="this.style.borderColor='#1a6fc4';this.style.color='#1a6fc4';" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#475569';">
                Selanjutnya <i class="fas fa-chevron-right" style="font-size:0.7rem;"></i>
            </a>
        @else
            <span style="display:inline-flex;align-items:center;gap:4px;padding:6px 14px;border-radius:6px;border:1px solid #e2e8f0;color:#cbd5e1;font-size:0.85rem;font-weight:600;cursor:not-allowed;background:#f8fafc;">
                Selanjutnya <i class="fas fa-chevron-right" style="font-size:0.7rem;"></i>
            </span>
        @endif

    </nav>
</div>
@endif
