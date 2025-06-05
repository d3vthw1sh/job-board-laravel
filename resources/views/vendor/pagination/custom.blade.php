@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-4 mb-12">
        <ul class="inline-flex items-center space-x-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-3 py-1 rounded-md bg-[#191E29] text-gray-500 cursor-not-allowed select-none">&lt;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="px-3 py-1 rounded-md bg-[#01C38D] text-[#132D46] font-semibold hover:opacity-90 transition">&lt;</a>
                </li>
            @endif

            {{-- First Page --}}
            @if ($paginator->currentPage() > 2)
                <li>
                    <a href="{{ $paginator->url(1) }}"
                        class="px-3 py-1 rounded-md bg-[#191E29] text-[#01C38D] font-semibold hover:opacity-90 transition">1</a>
                </li>
            @endif

            {{-- Ellipsis before current page --}}
            @if ($paginator->currentPage() > 3)
                <li><span class="px-2 text-gray-400">...</span></li>
            @endif

            {{-- Page before current --}}
            @if ($paginator->currentPage() > 1)
                <li>
                    <a href="{{ $paginator->url($paginator->currentPage() - 1) }}"
                        class="px-3 py-1 rounded-md bg-[#191E29] text-[#01C38D] font-semibold hover:opacity-90 transition">
                        {{ $paginator->currentPage() - 1 }}
                    </a>
                </li>
            @endif

            {{-- Current Page --}}
            <li>
                <span class="px-3 py-1 rounded-md bg-[#01C38D] text-[#132D46] font-bold border border-[#01C38D]">{{ $paginator->currentPage() }}</span>
            </li>

            {{-- Page after current --}}
            @if ($paginator->currentPage() < $paginator->lastPage())
                <li>
                    <a href="{{ $paginator->url($paginator->currentPage() + 1) }}"
                        class="px-3 py-1 rounded-md bg-[#191E29] text-[#01C38D] font-semibold hover:opacity-90 transition">
                        {{ $paginator->currentPage() + 1 }}
                    </a>
                </li>
            @endif

            {{-- Ellipsis after current page --}}
            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                <li><span class="px-2 text-gray-400">...</span></li>
            @endif

            {{-- Last Page --}}
            @if ($paginator->currentPage() < $paginator->lastPage() - 1)
                <li>
                    <a href="{{ $paginator->url($paginator->lastPage()) }}"
                        class="px-3 py-1 rounded-md bg-[#191E29] text-[#01C38D] font-semibold hover:opacity-90 transition">
                        {{ $paginator->lastPage() }}
                    </a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="px-3 py-1 rounded-md bg-[#01C38D] text-[#132D46] font-semibold hover:opacity-90 transition">&gt;</a>
                </li>
            @else
                <li>
                    <span class="px-3 py-1 rounded-md bg-[#191E29] text-gray-500 cursor-not-allowed select-none">&gt;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
