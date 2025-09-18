@include('theme::commons.header')
@include('theme::commons.main_nav')

@if(empty($cari) AND request()->segment(2) != 'kategori' AND (request()->segment(2) !== 'index' AND request()->segment(1) !== 'index')) 
  <div class="w-full max-w-container mx-auto px-3 z-20 relative">
    <div class="bg-slate-300 flex flex-col lg:flex-row shadow overflow-hidden">
      <div class="lg:w-2/3 lg:block">
        @include('theme::partials.slider')
      </div>
      <div class="lg:w-1/3 w-full px-5 py-5 space-y-8 bg-tertiary text-white">
        @include('theme::partials.headline')
      </div>
    </div>
  </div>
@endif

<main class="container px-3 max-w-container mx-auto space-y-5 my-5">
  @php $show_shortcut_links = boolval(theme_config('shortcut_links')) @endphp
  @if($show_shortcut_links) 
    @include('theme::widgets.shortcut_links')
  @endif
  @include('theme::partials.newsticker')

  @if(empty($cari) AND request()->segment(2) != 'kategori' AND (request()->segment(2) !== 'index' AND request()->segment(1) !== 'index')) 
    @include('theme::widgets.prayer_time')
    <section class="bg-white dark:bg-dark-secondary dark:border-gray-500 flex gap-5 border shadow rounded-lg py-5">
      <div class="lg:w-1/3 px-5 hidden lg:block">
        <img loading="lazy" src="{{ theme_asset('images/bg-desa.svg' . '?' . $theme_version) }}" alt="bg desa" style="clip-path: polygon(0% 7%, 23% 1%, 51% 2%, 71% 4%, 80% 9%, 83% 11%, 84% 12%, 88% 16%, 88% 16%, 90% 19%, 92% 22%, 92% 30%, 92% 36%, 95% 47%, 93% 59%, 97% 66%, 98% 76%, 98% 76%, 98% 82%, 96% 89%, 93% 93%, 88% 96%, 81% 98%, 67% 98%, 52% 100%, 42% 100%, 32% 100%, 17% 98%, 7% 98%, 1% 98%, 4% 88%, 5% 82%, 5% 73%, 5% 65%, 4% 57%, 1% 49%, 1% 33%, 1% 19%);-webkit-clip-path: polygon(0% 7%, 23% 1%, 51% 2%, 71% 4%, 80% 9%, 83% 11%, 84% 12%, 88% 16%, 88% 16%, 90% 19%, 92% 22%, 92% 30%, 92% 36%, 95% 47%, 93% 59%, 97% 66%, 98% 76%, 98% 76%, 98% 82%, 96% 89%, 93% 93%, 88% 96%, 81% 98%, 67% 98%, 52% 100%, 42% 100%, 32% 100%, 17% 98%, 7% 98%, 1% 98%, 4% 88%, 5% 82%, 5% 73%, 5% 65%, 4% 57%, 1% 49%, 1% 33%, 1% 19%);">
      </div>
      <div class="lg:w-2/3 w-full space-y-1 px-3">
        <h2 class="text-heading text-xl lg:text-2xl font-bold" data-aos="fade-zoom-in">Serba Serbi {{ ucwords(setting('sebutan_desa')) }}</h2>
        <p class="text-sm">Kenali {{ ucwords($desa['nama_desa']) }} lebih dekat</p>
        <p class="pt-3">Website ini dikelola Pemerintah {{ ucwords(setting('sebutan_desa')) .' '. ucwords($desa['nama_desa']) }},
            {{ ucwords(setting('sebutan_kecamatan')) .' '. ucwords($desa['nama_kecamatan']) }},
            {{ ucwords(setting('sebutan_kabupaten')) .' '. ucwords($desa['nama_kabupaten']) }} yang bertujuan untuk membuka akses seluas-luasnya kepada masyarakat desa, termasuk terkait pengelolaan dana desa dan capaian pembangunan desa.</p>
        <div class="relative">
          <ul class="slider-nav">
            <li class="slider-nav-item slider-nav-prev" disabled><span class="ti ti-chevron-left"></span></li>
            <li class="slider-nav-item slider-nav-next"><span class="ti ti-chevron-right"></span></li>
          </ul>
          <aside class="grid grid-cols-1 lg:grid-cols-3 gap-5 rounded-lg owl-carousel dash-carousel pt-5 relative">
            @foreach($widgetAktif as $w) 
              @if($w['isi'] == 'layanan_mandiri' or $w['isi'] == 'keuangan' or $w['isi'] == 'aparatur_desa') 
                @php continue; @endphp
              @endif
              @if($w['jenis_widget'] == 1) 
                <div class="sidebar-item">
                  @php $widget = str_replace('.php', '', $w['isi']) @endphp
                  @include("theme::widgets.$widget")
                </div>
              @endif
            @endforeach
          </aside>
        </div>
      </div>
    </section>
    @php $show_village_staffs = boolval(theme_config('village_staffs')) @endphp
    @if($show_village_staffs) 
      @include('theme::widgets.aparatur_desa', ['is_home' => true])
    @endif
  @endif

  <section id="article-list" class="space-y-4 py-5">
    <h2 class="text-heading text-xl lg:text-3xl font-bold mb-5"><i class="ti ti-file-text inline-block mr-2 h-10 text-primary dark:text-white"></i> {{ strip_tags($cari) ?: 'Berita ' . ucwords(setting('sebutan_desa')) }}</h2>
    <ul class="flex space-x-2 lg:space-x-0 lg:gap-2 lg:flex-wrap overflow-x-auto pb-2">
      <li class="flex-shrink-0">
        @php $active_home = request()->segment(2) !== 'kategori' @endphp
        <a href="{{ site_url() }}" class="inline-block px-4 py-2 text-sm rounded-lg transition duration-200 shadow-md {{ $active_home ? 'bg-secondary text-white border-2 border-transparent hover:border-secondary' : 'bg-white hover:text-secondary border-2 border-transparent hover:border-secondary dark:text-white dark:bg-dark-secondary' }}">
            Terbaru 
            @if($active_home)
              <i class="ti ti-check inline-block icon icon-sm"></i>
            @endif
          </a>
      </li>
      @foreach($menu_kiri as $menu) 
        <li class="flex-shrink-0">
          @php $active_menu = request()->segment(2) === 'kategori' && request()->segment(3) === $menu['slug'] @endphp
          <a href="{{ site_url('artikel/kategori/'.$menu['slug']) }}" class="inline-block px-4 py-2 text-sm rounded-lg transition duration-200 shadow-md {{ $active_menu ? 'bg-secondary text-white border-2 border-transparent hover:border-secondary' : 'bg-white hover:text-secondary border-2 border-transparent hover:border-secondary dark:bg-dark-secondary dark:text-white' }}">
            {{ $menu['kategori'] }}
            @if($active_menu)
              <i class="ti ti-check inline-block icon icon-sm"></i>
            @endif
          </a>
        </li>
        @if(count($menu['submenu']) > 0) 
          @foreach($menu['submenu'] as $submenu) 
            @php $active_menu = request()->segment(2) === 'kategori' && request()->segment(3) === $submenu['slug'] @endphp
            <li class="flex-shrink-0">
              <a href="{{ site_url('artikel/kategori/'.$submenu['slug']) }}" class="inline-block px-4 py-2 text-sm rounded-lg transition duration-200 shadow-md {{ $active_menu ? 'bg-secondary text-white border-2 border-transparent hover:border-secondary' : 'bg-white hover:text-secondary border-2 border-transparent hover:border-secondary dark:bg-dark-secondary dark:text-white' }}">
                {{ $submenu['kategori'] }}
                @if($active_menu)
                  <i class="ti ti-check inline-block icon icon-sm"></i>
                @endif
              </a>
            </li>
          @endforeach
        @endif
      @endforeach
    </ul>
    @if(count($artikel) > 0) 
      <div class="grid grid-cols-1 gap-5 lg:grid-cols-3 md:grid-cols-2">
      @foreach($artikel as $post) 
        @php $data['post'] = $post @endphp
        @include('theme::partials.artikel.list', $data)
      @endforeach
      </div>
      @php $data['paging_page'] = $paging_page @endphp
      @include('theme::commons.paging', $data)
      @else 
        @php $data['title'] = $title @endphp
        @include('theme::partials.empty_article', $data)
    @endif
  </section>

  @if(empty($cari) AND request()->segment(2) != 'kategori') 
    @php $show_layanan_mandiri = boolval(theme_config('layanan_mandiri')) @endphp
    @if($show_layanan_mandiri) 
      @include('theme::partials.self_service')
    @endif
  @endif
</main>