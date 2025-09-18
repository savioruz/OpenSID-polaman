<div class="box box-primary box-solid">
  <div class="box-header">
    <h3 class="box-title"><a href="{{ site_url('arsip')}}"><i class="ti ti-archive mr-1"></i> Arsip Artikel</a></h3>
  </div>
  <div id="arsip_artikel" class="box-body">
    <ul class="nav nav-tabs flex list-none !border-b !mb-0" id="tab-arsip" role="tablist">
      <li class="nav-item !pb-0 flex-grow text-center" role="presentation"><a href="#terkini"
          class="nav-link w-full block font-medium active"
          data-bs-toggle="pill" data-bs-target="#terkini" role="tab" aria-controls="terkini" aria-selected="true"
          data-toggle="tab" href="#terkini">Terkini</a></li>

      <li class="nav-item !pb-0 flex-grow text-center" role="presentation"><a href="#populer"
          class="nav-link w-full block font-medium"
          data-bs-toggle="pill" data-bs-target="#populer" role="tab" aria-controls="populer" aria-selected="false">Populer</a></li>

      <li class="nav-item !pb-0 flex-grow text-center" role="presentation"><a href="#acak"
          class="nav-link w-full block font-medium"
          data-bs-toggle="pill" data-bs-target="#acak" role="tab" aria-controls="acak" aria-selected="false">Acak</a>
      </li>
    </ul>

    <div class="tab-content" style="max-height:350px; overflow: auto;">
      @foreach(array('terkini' => 'arsip_terkini', 'populer' => 'arsip_populer', 'acak' => 'arsip_acak') as $jenis => $jenis_arsip) 
      <div id="{{ $jenis }}" class="tab-pane fade @php ($jenis == 'terkini') and print('in show active') @endphp" role="tabpanel">
        <div class="divide-y">
          @foreach($$jenis_arsip as $arsip)
          <div class="flex gap-3 py-3">
            <a href="{{ site_url('artikel/'.buat_slug($arsip)) }}" class="w-16 flex-shrink-0">
              @if(is_file(LOKASI_FOTO_ARTIKEL."kecil_$arsip[gambar]"))
              <img class="w-full h-auto" style="width:100%" src="{{ base_url(LOKASI_FOTO_ARTIKEL."sedang_$arsip[gambar]") }}" />
              @else
              <img class="w-full h-auto" style="width:100%" src="{{ base_url("assets/images/404-image-not-found.jpg") }}" />
              @php endif;@endphp
            </a>
            <div class="flex flex-col justify-between gap-2">
              <a href="{{ site_url('artikel/'.buat_slug($arsip))}}" class="block text-sm font-bold hover:text-primary-100">{{ $arsip['judul'] }}</a>
              <span class="text-xs"><i class="ti ti-calendar-alt mr-1 text-primary-100"></i> {{ tgl_indo($arsip['tgl_upload']) }}</span>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

@push('styles')
  <style type="text/css">
    .nav-tabs .active {
      /* color: var(--primary-color); */
      border: 1px solid #bcbcbc !important;
      border-bottom: 0 !important;
      margin-bottom: -2px;
      background-color: #fff;
      padding: 5px 10px;
      border-radius: 5px 5px 0 0;
    }
    .dark .nav-tabs .active {
      background-color: rgb(45 55 72 / var(--tw-bg-opacity));
      color: white;
    }
  </style>
@endpush
