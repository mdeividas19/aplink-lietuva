@if ($paginator->hasPages())
    <nav class="flex justify-center mt-8">
        <ul class="inline-flex items-center space-x-1">

            @if ($paginator->onFirstPage())
                <li class="px-3 py-2 text-stone-400 cursor-not-allowed">←</li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="px-3 py-2 bg-white border border-stone-300 rounded-md hover:bg-stone-100 transition">
                        ←
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="px-3 py-2 bg-stone-900 text-white rounded-md">
                                {{ $page }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="px-3 py-2 bg-white border border-stone-300 rounded-md hover:bg-stone-100 transition">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="px-3 py-2 bg-white border border-stone-300 rounded-md hover:bg-stone-100 transition">
                        →
                    </a>
                </li>
            @else
                <li class="px-3 py-2 text-stone-400 cursor-not-allowed">→</li>
            @endif

        </ul>
    </nav>
@endif