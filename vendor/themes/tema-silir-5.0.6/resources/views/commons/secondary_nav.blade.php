<div class="backdrop"></div>
<nav class="secondary-navigation">
  <div class="secondary-navigation-heading">Kategori</div>
  <ul class="secondary-navigation-list">
    @foreach($menu_kiri as $menu) 
      <li class="secondary-navigation-item">
        <a href="{{ site_url('artikel/kategori/{$menu['slug']}') }}" class="secondary-navigation-link">
          {{ $menu['kategori'] }}
          @if(count($menu['submenu']) > 0) 
            <i class="ti ti-chevron-right secondary-navigation-icon"></i>
          @endif
        </a>
        @if(count($menu['submenu']) > 0) 
          <ul class="secondary-navigation-dropdown">
            @foreach($menu['submenu'] as $submenu) 
              <li class="secondary-navigation-dropdown-item">
                <a href="{{ site_url('artikel/kategori/{$submenu['slug']}') }}" class="secondary-navigation-dropdown-link">{{ $submenu['kategori'] }}</a>
              </li>
            @endforeach
          </ul>
        @endif
      </li>
    @endforeach
  </ul>
</nav>