<div class="container px-3 max-w-container mx-auto space-y-5 my-5">
  @if($transparansi) @include('theme::partials.apbdesa', $transparansi) @endif
</div>

@include('theme::commons.bottom_nav')

<footer class="footer">
  <div class="footer-inner">
    <div class="footer-widget">
      <div class="footer-column">
        <div class="footer-brand">
          <img loading="lazy" src="{{ gambar_desa($desa['logo']) }}" alt="Logo {{ ucwords(setting('sebutan_desa')).' '.ucwords($desa['nama_desa']) }}" class="footer-brand-image">
          <p class="footer-brand-caption">
            {{ ucwords(setting('sebutan_desa')).' '.ucwords($desa['nama_desa']) }}
          </p>
        </div>
        <p class="footer-info">
          Website Resmi Pemerintah {{ ucwords(setting('sebutan_desa')).' '.ucwords($desa['nama_desa']) }},
          {{ ucwords(setting('sebutan_kecamatan')) }}
          {{ ucwords($desa['nama_kecamatan']) }},
          {{ ucwords(setting('sebutan_kabupaten')) }}
          {{ ucwords($desa['nama_kabupaten']) }}
        </p>
        <ul class="footer-smed">
          @foreach($sosmed as $data) 
            @if(!empty($data['link'])) 
              <li title="{{ $data['nama'] }}" class="mr-2 rounded-full border-2 transition-all duration-200 hover:bg-secondary">
                <a href="{{ $data['link'] }}" target="_blank" class="inline-flex items-center justify-center p-2 w-10 h-10">
                  <i class="ti ti-brand-{{ strtolower(str_replace(' ', '-', $data['nama'])) }} text-2xl"></i>
                </a>
              </li>
            @endif
          @endforeach
        </ul>
      </div>
      <div class="footer-column">
        <h3 class="footer-heading items-center flex"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mr-2 inline-block text-tertiary"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" /></svg> Hubungi Kami</h3>
        <p class="footer-info">
          {{ ucwords($desa['alamat_kantor']) }},
          {{ ucwords(setting('sebutan_desa')) .' '. ucwords($desa['nama_desa']) }},
          {{ ucwords(setting('sebutan_kecamatan')) .' '. ucwords($desa['nama_kecamatan']) }},
          {{ ucwords(setting('sebutan_kabupaten')) .' '. ucwords($desa['nama_kabupaten']) }},
          Provinsi {{ ucwords($desa['nama_propinsi']) }},
          Indonesia,
          {{ $desa['kode_pos'] }}.
        </p>
        <ul class="footer-contact">
          @if($desa['telepon']) 
            <li class="footer-contact-item"><i class="ti ti-device-landline-phone mr-2 text-secondary"></i><span>Telepon/Fax: {{ $desa['telepon'] }}</span></li>
          @endif
          @if($desa['nomor_operator']) 
            <li class="footer-contact-item"><i class="ti ti-phone mr-2 text-secondary"></i><span>No. HP: {{ $desa['nomor_operator'] }}</span></li>
          @endif
          @if($desa['email_desa']) 
            <li class="footer-contact-item"><i class="ti ti-mail mr-2 text-secondary"></i><span>Email: {{ $desa['email_desa'] }}</span></li>
          @endif
        </ul>
      </div>
      <div class="footer-column">
        <h3 class="footer-heading items-center flex"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 inline-block mr-2 text-tertiary"> <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" /></svg> Album Galeri</h3>
        <div class="footer-album">
          @php $w_gal = $w_gal->take(3) @endphp
          @foreach($w_gal as $album) 
            @php $link = site_url('galeri/'.$album['id']) @endphp
            @php $image_src = $album['jenis'] == 2 ? $album['gambar'] : AmbilGaleri($album['gambar'], 'kecil') @endphp
            <a href="{{ $link }}" class="footer-album-item">
              <img loading="lazy" src="{{ $image_src }}" alt="{{ $album['nama'] }}" title="{{ $album['nama'] }}" class="footer-album-image">
            </a>
          @endforeach
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <span>Hak cipta &copy; {{ date('Y') }} - Pemerintah <a href="{{ site_url() }}">{{ NAMA_DESA }}</a> - <a href="https://github.com/OpenSID/OpenSID" target="_blank">OpenSID {{ ambilVersi() }}</a> | <a href="https://opendesa.id" target="_blank">OpenDesa</a> | <a href="https://silirdev.com" target="_blank">Tema Silir {{ $theme_version }}</a>@if(file_exists('mitra')) | Hosting didukung <a href="https://my.idcloudhost.com/aff.php?aff=3172" rel="noopener noreferrer" target="_blank"> <img loading="lazy" src="{{ theme_asset('images/Logo-IDcloudhost.png') }}" class="h-4 inline-block" alt="Logo-IDCloudHost" title="Logo-IDCloudHost"></a>@endif</span>
    </div>
  </div>
</footer>

<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="notif-modal" tabindex="-1" role="dialog" aria-labelledby="notif" aria-hidden="true">
  <div class="modal-dialog relative w-auto modal-dialog-centered">
    <div class="modal-content rounded-lg">
      <div class="modal-header px-4 py-3 flex flex-row-reverse items-center text-left text-slate-800 border-b dark:border-slate-800">
        <button type="button" class="btn-close box-content w-4 h-4 p-1 text-inherit border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:no-underline" data-bs-dismiss="modal" aria-label="Tutup"><i class="ti ti-close"></i></button>
        <h4 class="modal-title font-bold text-left w-full dark:text-white"></h4>
      </div>
      <div class="modal-body relative px-4 py-3">
      </div>
    </div>
  </div>
</div>

@include('theme::commons.scroll_top')