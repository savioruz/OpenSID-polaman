@if($paginator->hasPages()) 
  <span class="block text-sm">Halaman {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}</span>
  <nav aria-label="nomor halaman">
    <ul class="pagination mt-1 mb-5">
      @if ($paginator->onFirstPage())
        @else 
          <li>
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link"><i class="ti ti-chevrons-left icon-base inline-block"></i></a>
          </li>
      @endif
      <li>
        <a href="{{ $paginator->url(1) }}" class="pagination-link"><i class="ti ti-chevron-left icon-base inline-block"></i></a>
      </li>
      @foreach ($elements as $element)
        {{-- Array Of Links --}}
        @if (is_array($element))
          @php
            $currentPage = $paginator->currentPage();
            $lastPage = $paginator->lastPage();
            
            if ($currentPage <= 3) {
              $pages = range(1, min(3, $lastPage));
            } else {
              $pages = range(max(1, $currentPage - 2), min($lastPage, $currentPage + 2));
            }
          @endphp

          @foreach ($element as $page => $url)
            @if (in_array($page, $pages))
              @if ($page == $currentPage)
                <li aria-current="page"><span class="pagination-link is-active">{{ $page }}</span></li>
              @else
                <li><a class="pagination-link" href="{{ $url }}">{{ $page }}</a></li>
              @endif
            @endif
          @endforeach
        @endif
      @endforeach

      {{-- Next Page Link --}}
      @if ($paginator->hasMorePages())
        <li>
          <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="pagination-link"><i class="ti ti-chevron-right inline-block"></i></a>
        </li>
      @else
      @endif
      <li>
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="pagination-link"><i class="ti ti-chevrons-right inline-block"></i></a>
      </li>
    </ul>
  </nav>
@endif
