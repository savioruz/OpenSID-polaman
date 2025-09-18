@if($headline or $artikel)
  @php $headline = $headline ?? $artikel->take(1)[0] @endphp
  @php $abstrak_headline = potong_teks($headline['isi'], 250); @endphp
  @php $url = $headline['url_slug']; @endphp
  @php $image = ($headline['gambar'] && is_file(LOKASI_FOTO_ARTIKEL.'sedang_'.$headline['gambar'])) ?
    AmbilFotoArtikel($headline['gambar'],'sedang') :
    gambar_desa($desa['logo']);
  @endphp
  <article class="flex flex-col gap-3">
    <div class="flex-shrink-0 w-full h-auto rounded-lg  @php $image === gambar_desa($desa['logo']) and print('flex items-center') @endphp" style="background: transparent">
      <img loading="lazy" src="{{ $image }}" alt="{{ $headline['judul'] }}" class="@php $image !== gambar_desa($desa['logo']) and print('article-image') @endphp mx-auto">
    </div>
    <div class="flex flex-col justify-between space-y-2">
      <div class="space-y-1">
        <a href="{{ $url }}" class="text-heading lg:text-lg block">{{ $headline['judul'] }}</a>
        <p class="text-sm">{{ $abstrak_headline }}..</p>
      </div>
      <a href="{{ $url }}" class="button button-secondary w-36 text-sm" data-mdb-ripple="true" data-mdb-ripple-color="light">Selengkapnya <span class="icon icon-base me-2 inline ti ti-chevron-right"></span></a>
    </div>
  </article>
@endif