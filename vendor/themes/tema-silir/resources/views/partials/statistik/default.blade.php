<h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title">Demografi Berdasar {{ $heading ?? 'Program Bantuan' }}</h1>
<div class="bg-slate-200 dark:bg-dark-primary py-3 px-5 border-l-4 border-secondary my-5 space-y-3">
  <p class="text-justify text-sm">{{ $judul }}</p>
</div>
@if(isset($list_tahun))
  <select class="form-input inline-block w-full" id="tahun" name="tahun">
      <option selected="" value="">Semua Tahun</option>
      @foreach($list_tahun as $item_tahun)
        <option @selected($item_tahun == $selected_tahun) value="{{ $item_tahun }}">{{ $item_tahun }}</option>
      @endforeach
  </select>
@endif

<div class="flex flex-col lg:flex-row justify-between items-center space-x-1">
  <h2 class="text-heading text-base lg:text-xl w-auto">Grafik {{ $heading ?? 'Program Bantuan' }}</h2>
  <div class="lg:text-right space-x-2 text-xs lg:text-sm space-y-2 md:space-y-0">
    <button type="button" class="button button-secondary button-switch" data-type="column" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-chart-bar"></i> Bar Graph</button>
    <button type="button" class="button button-secondary button-switch is-active" disabled data-type="pie" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-chart-pie"></i> Pie Graph</button>
    <a href="{{ ci_route("data-statistik.{$slug_aktif}.cetak.cetak") }}?tahun={{ $selected_tahun }}"
      class="button button-tertiary visible-lg-inline-block"
      title="Cetak Laporan" target="_blank">
        <i class="ti ti-printer"></i> <span class="hidden lg:inline-block">Cetak</span>
    </a>
    <a href="{{ ci_route("data-statistik.{$slug_aktif}.cetak.unduh") }}?tahun={{ $selected_tahun }}"
        class="button button-tertiary"
        title="Unduh Laporan" target="_blank">
        <i class="ti ti-download"></i> <span class="hidden lg:inline-block">Unduh</span>
    </a>
  </div>
</div>

<div id="statistics-one">
  <div class="text-heading flex justify-center items-center" style="min-height:300px;">@include('theme::commons.loading')</div>
</div>

<h2 class="text-heading text-base lg:text-xl">Tabel {{ $heading ?? 'Program Bantuan' }}</h2>
<div class="table-responsive overflow-auto w-full" id="statistic-table">
  <table class="w-full text-sm">
    <thead>
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Kelompok</th>
        <th colspan="2">Jumlah</th>
        <th colspan="2">Laki-laki</th>
        <th colspan="2">Perempuan</th>
      </tr>
      <tr>
        <th>n</th>
        <th>%</th>
        <th>n</th>
        <th>%</th>
        <th>n</th>
        <th>%</th>
      </tr>
    </thead>
    <tbody>
      <tr><td colspan="11">@include('theme::commons.loading')</td></tr>
    </tbody>
  </table>
  <p class="text-xs text-slate-500 py-2 text-right">
    Diperbarui pada : {{ tgl_indo($last_update) }}
  </p>
</div>
<div class="flex justify-between"> 
  <button type="button" class="button button-primary button-more" id="showData" data-mdb-ripple="true" data-md-ripple-color="light">Selengkapnya...</button>
  <button type="button" id="showZero" class="button button-secondary" data-mdb-ripple="true" data-md-ripple-color="light">Tampilkan Nol</button>
</div>

@if(setting('daftar_penerima_bantuan') && $bantuan)
  <script>
    const bantuanUrl = '{{ ci_route('internal_api.peserta_bantuan', $key) }}?filter[tahun]={{ $selected_tahun ?? '' }}'
  </script>

  <h2 class="text-heading text-base lg:text-xl">Daftar {{ $heading ?? 'Program Bantuan' }}</h2>

  <div class="table-responsive overflow-auto w-full !mt-0">
    <table class="w-full text-sm" id="peserta_program_bantuan">
      <thead>
        <tr>
          <th>No</th>
          <th>Program</th>
          <th>Nama Peserta</th>
          <th>Alamat</th>
        </tr>
      </thead>
      <tbody>
        <tr><td colspan="4">@include('theme::commons.loading')</td></tr>
      </tbody>
    </table>
  </div>
@endif

@push('styles')
  <style>
    .button-switch.is-active {
      cursor: not-allowed;
      pointer-events: none;
      opacity: 60%;
    }
  </style>
@endpush

@push('scripts')
  <script>
    const statistikUrl = `{{ ci_route('internal_api.statistik', $key) }}?tahun={{ $selected_tahun ?? '' }}`;
  </script>
  <script src="{{ theme_asset('lib/js/statistik.min.js?' . $theme_version) }}"></script>
@endpush