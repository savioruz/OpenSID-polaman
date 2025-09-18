<header class="header">
  <section class="header-top">
    <div class="header-top-inner">
      <div class="header-top-left">
        <div class="header-top-contact">
          @if($desa['telepon']) 
          <div class="contact-item">
            <span class="icon icon-sm pr-1 text-secondary ti ti-phone"></span>
            <span>{{ $desa['telepon'] }}</span>
          </div>
          @endif
          @if($desa['email_desa']) 
          <div class="contact-item">
            <span class="icon icon-sm pr-1 text-secondary ti ti-mail"></span>
            <span>{{ $desa['email_desa'] }}</span>
          </div>
          @endif
        </div>
      </div>
      <div class="header-top-right">
        @foreach($sosmed as $data) 
          @if(!empty($data['link'])) 
            <a href="{{ $data['link'] }}" target="_blank" rel="noopener" class="header-top-right-link py-0">
              <span class="ti mx-1 text-lg ti-brand-{{ strtolower(str_replace(' ', '-', $data['nama']))}}"></span>
            </a>
          @endif
        @endforeach
        <div class="toggle ml-3">
          <div class="toggle-track">
            <div class="toggle-item dark" title="dark mode"><span class="ti ti-moon text-lg"></span></div>
            <div class="toggle-item light" title="light mode"><span class="ti ti-sun text-lg"></span>
            </div>
          </div>
          <div class="toggle-indicator is-dark"></div>
          <input type="checkbox" class="toggle-check" />
        </div>
      </div>
    </div>
  </section>
  <section class="header-bottom">
    <div class="header-bottom-inner">
      <a href="{{ site_url() }}" class="brand">
        <img loading="lazy" src="{{ gambar_desa($desa['logo']) }}" alt="Logo {{ ucwords(setting('sebutan_desa')).' '.ucwords($desa['nama_desa']) }}" class="brand-image">
        <div class="brand-name">
          <span class="brand-title typed">Sistem Informasi {{ $nama_desa }}</span>
          <span id="typed" class="brand-title"></span>
          <p class="brand-tagline">{{ ucwords(setting('sebutan_kecamatan_singkat')) }}
            {{ ucwords($desa['nama_kecamatan']) }}
            {{ ucwords(setting('sebutan_kabupaten_singkat')) }}
            {{ ucwords($desa['nama_kabupaten']) }}</p>
        </div>
      </a>
      <form action="{{ site_url() }}" method="GET" class="form mt-4 lg:mt-0">
        <div class="form-search">
          <input type="search" name="cari" id="cari" class="form-search-input" placeholder="Cari...">
          <button class="form-search-button"><span class="ti ti-search mx-2"></span></button>
        </div>
      </form>
    </div>
  </section>
</header>
