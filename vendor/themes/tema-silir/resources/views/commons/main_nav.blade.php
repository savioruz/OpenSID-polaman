<nav class="main-nav is-sticky hidden lg:block">
  <div class="main-nav-inner">
    <ul class="navigation">
      <div class="navigation-item inline-block lg:hidden uppercase pt-3 pb-1 tracking-wide font-bold text-lg">Menu</div>

      <li class="navigation-item is-active lg:inline-block">
        <a href="{{ site_url() }}" class="navigation-link"><span class="ti ti-home icon icon-base"></span></a>
      </li>
      
      @if(menu_tema()) 
        @php 
          function generateSubTree($items) {
            $html = '<ul class="navigation-subtree">';
              foreach ($items as $item) {
                  $html .= '<li class="navigation-subtree-item">';
                  $html .= '<a href="' . $item['link_url'] . '" class="navigation-subtree-link">' . $item['nama'];
                  
                  // Check if item has children
                  if (!empty($item['childrens'])) {
                      $html .= '<span class="ti ti-chevron-right ml-2 navigation-icon"></span></a>';
                      $html .= generateSubTree($item['childrens']);
                  } else {
                      $html .= '</a>';
                  }
                  
                  $html .= '</li>';
              }
              $html .= '</ul>';
              return $html;
          }
        @endphp
        @foreach(menu_tema() as $menu) 
          @php $has_dropdown = count($menu['childrens']) > 0 @endphp
          <li class="navigation-item">
            <a href="{{ $menu['link_url'] }}" class="navigation-link font-medium font-bold lg:font-normal">{{ $menu['nama'] }}
              @if($has_dropdown) 
                <i class="ti ti-chevron-down icon icon-base ml-2 navigation-icon"></i>
              @endif
            </a>
            @if($has_dropdown) 
              <ul class="navigation-dropdown">
                @foreach($menu['childrens'] as $submenu) 
                  @php $has_dropdown = count($submenu['childrens']) > 0 @endphp
                  <li class="navigation-dropdown-item">
                    <a href="{{ $submenu['link_url'] }}" class="navigation-dropdown-link">{{ $submenu['nama'] }}
                    @if($has_dropdown) 
                      <i class="ti ti-chevron-right icon icon-base ml-2 navigation-icon"></i>
                    @endif
                    </a>
                    {!! generateSubTree($submenu['childrens']) !!}
                  </li>
                @endforeach
              </ul>
            @endif
          </li>
        @endforeach
      @endif
    </ul>
  </div>
</nav>
@include('theme::commons.drawer')