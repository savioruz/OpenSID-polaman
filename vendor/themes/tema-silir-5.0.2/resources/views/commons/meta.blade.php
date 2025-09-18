@php
  $constants = [
      'IS_RAMADHAN' => $is_ramadhan,
      'THEME_VERSION' => $theme_version,
      'THEME_TIMESTAMP' => $theme_timestamp,
      'IS_PREMIUM' => $is_premium,
      'NAMA_DESA' => $nama_desa,
      'THEME_COLOR_SCHEME' => $theme_color,
  ];

  foreach ($constants as $key => $value) {
    defined($key) or define($key, $value);
  }
@endphp

@php $title = preg_replace("/[^A-Za-z0-9- ]/", '', trim(str_replace('-', ' ', get_dynamic_title_page_from_path())));
      $suffix = setting('website_title')
          . ' ' . ucwords(setting('sebutan_desa'))
          . (($desa['nama_desa']) ? ' ' . $desa['nama_desa'] : '');
      $desa_title = $title ?  $title.' - '.$suffix : $suffix @endphp

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="google" content="notranslate" />
<meta name="theme" content="Silir" />
<meta name="designer" content="Diki Siswanto" />
<meta name="theme:designer" content="Diki Siswanto" />
<meta name="theme:version" content="{{ THEME_VERSION }}" />
<meta name="opensid:version" content="{{ ambilVersi() }}" />
<meta name="theme-color" content="#efefef">
<meta name="keywords' content="{{ $desa_title }} @php !strpos($desa_title, NAMA_DESA) and print(NAMA_DESA) @endphp {{ ucwords(setting('sebutan_kecamatan')) }} {{ ucwords($desa['nama_kecamatan']) }}, {{ ucwords(setting('sebutan_kabupaten')) }} {{ ucwords($desa['nama_kabupaten']) }}, Provinsi  {{ ucwords($desa['nama_propinsi']) }}" />
<meta property="og:site_name" content="{{ NAMA_DESA }}"/>
<meta property="og:type" content="article"/>
<link rel="canonical" href="{{ site_url() }}"/>
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1"/>
<meta name="subject" content="Situs Web {{ ucwords(setting('sebutan_desa')) }}">
<meta name="copyright" content="{{ NAMA_DESA }}">
<meta name="language" content="Indonesia">
<meta name="Classification" content="Government">
<meta name="url" content="{{ site_url() }}">
<meta name="identifier-URL" content="{{ site_url() }}">
<meta name="category" content="Desa, Pemerintahan">
<meta name="coverage" content="Worldwide">
<meta name="distribution" content="Global">
<meta name="rating" content="General">
<meta name="revisit-after" content="7 days">
<meta name="revisit-after" content="7"/>
<meta name="webcrawlers" content="all"/>
<meta name="rating" content="general"/>
<meta name="spiders" content="all"/>
<link rel="alternate" type="application/rss+xml" title="Feed {{ NAMA_DESA }}" href="{{ site_url('sitemap') }}"/>

@if(isset($single_artikel))
  <title>{{ $single_artikel['judul'] . " - " . NAMA_DESA }}</title>
  <meta name="description" content="{{ str_replace('"', "'", substr(strip_tags($single_artikel['isi']), 0, 150)); }}" />
  <meta property="og:title" content="{{ $single_artikel['judul'] }}"/>
  <meta itemprop="name" content="{{ $single_artikel['judul'] }}"/>
  <meta itemprop='description' content="{{ str_replace('"', "'", substr(strip_tags($single_artikel['isi']), 0, 150)); }}" />
  @if(trim($single_artikel['gambar'])!='')
    <meta property="og:image" content="{{ base_url() . LOKASI_FOTO_ARTIKEL . 'kecil_'.$single_artikel['gambar'] }}"/>
    <meta itemprop="image" content="{{ base_url() . LOKASI_FOTO_ARTIKEL . 'kecil_'.$single_artikel['gambar'] }}"/>
  @endif
  <meta property='og:description' content="{{ str_replace('"', "'", substr(strip_tags($single_artikel['isi']), 0, 150)); }}" />
@else
  <title>{{ $desa_title }}</title>
  <meta name="description" content="{{ $desa_title }} @php !strpos($desa_title, NAMA_DESA) and print(NAMA_DESA) @endphp {{ ucwords(setting('sebutan_kecamatan')) }} {{ ucwords($desa['nama_kecamatan']) }}, {{ ucwords(setting('sebutan_kabupaten')) }} {{ ucwords($desa['nama_kabupaten']) }}, Provinsi  {{ ucwords($desa['nama_propinsi']) }}" />
  <meta itemprop="name" content="{{ $desa_title }}"/>
  <meta property="og:title" content="{{ $desa_title }}"/>
  <meta property='og:description' content="{{ $desa_title }} @php !strpos($desa_title, NAMA_DESA) and print(NAMA_DESA) @endphp {{ ucwords(setting('sebutan_kecamatan')) }} {{ ucwords($desa['nama_kecamatan']) }}, {{ ucwords(setting('sebutan_kabupaten')) }} {{ ucwords($desa['nama_kabupaten']) }}, Provinsi  {{ ucwords($desa['nama_propinsi']) }}" />
@endif
<meta property='og:url' content="{{ current_url(); }}" />
@if(is_file(LOKASI_LOGO_DESA . "favicon.ico"))
<link rel="shortcut icon" href="{{ base_url() . LOKASI_LOGO_DESA . 'favicon.ico' }}" />
@else
<link rel="shortcut icon" href="{{ base_url('favicon.ico') }}" />
@endif
<link rel="manifest" id="manifest">
<noscript>You must have JavaScript enabled in order to use this theme. Please enable JavaScript and then reload this page in order to continue.</noscript>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.1.0/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-providers/1.6.0/leaflet-providers.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-gl/1.11.1/mapbox-gl.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-gl-leaflet/0.0.14/leaflet-mapbox-gl.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.carousel.min.js"></script>
<script src="{{ base_url('assets/js/peta.js') }}"></script>
<script>
  const BASE_URL = '{{ base_url() }}';
  const SITE_URL = '{{ site_url() }}';
  const setting  = @json(setting());
  const config   = @json(identitas());
  const COVID_PROVINCE_CODE = {{ setting('provinsi_covid') ? : 'undefined' }};
  const APP_TITLE = '{{ NAMA_DESA }}';
  const APP_SHORT_TITLE = '{{ NAMA_DESA }}';
  const APP_DESCRIPTION = `Aplikasi ${APP_TITLE}`;
  const LOGO_URL = '{{ theme_asset('app-icons') }}';
  const SW_URL = '{{ base_url('sw.js') }}';
  const PROXY_ENDPOINT_COVID_API = '{{ site_url('ambil_data_covid') }}';
  const THEME_TIMESTAMP = '{{ THEME_TIMESTAMP }}';
  const IS_RAMADHAN = {{ IS_RAMADHAN ? 'true' : 'false'  }};
  if ( IS_RAMADHAN ) {
    localStorage.setItem('colorScheme', 'ramadhan');
  }
</script>