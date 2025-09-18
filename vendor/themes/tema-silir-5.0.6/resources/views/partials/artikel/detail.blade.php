@extends('theme::layouts.master')

@section('content')
  @php $post = $single_artikel @endphp

  @if($post['kategori']) 
    <a href="{{ site_url('artikel/kategori/'.$post['kat_slug']) }}" class="rounded-full bg-tertiary text-white px-3 py-1 text-sm">
      {{ $post['kategori'] }}
    </a>
  @endif

  <div class="main-content print space-y-4">
    <h1 class="text-heading text-lg lg:text-2xl border-b dark:border-slate-800 border-dotted border-primary dark:border-white pb-2 title">
      {{ $post['judul'] }}
    </h1>

    <div class="flex flex-wrap gap-2 text-sm">
      <div class="inline-flex items-center mr-2.5 mb-1">
        <span class="icon text-secondary mr-2 ti ti-calendar"></span>
        <span>{{ $post['tgl_upload_local']  }}</span>
      </div>
      <div class="inline-flex items-center mr-2.5 mb-1">
        <span class="icon text-secondary mr-2 ti ti-user"></span>
        <span>{{ $post['owner'] }}</span>
      </div>
      <div class="inline-flex items-center">
        <span class="icon text-secondary mr-2 ti ti-book"></span>
        <span>Dibaca {{ hit($post['hit'])  }}</span>
      </div>
    </div>

    @if($post['gambar'] && is_file(LOKASI_FOTO_ARTIKEL.'sedang_'.$post['gambar'])) 
      <a href="{{ AmbilFotoArtikel($post['gambar'],'sedang') }}" class="block" data-fancybox="images">
        <figure>
          <img loading="lazy" src="{{ AmbilFotoArtikel($post['gambar'],'sedang') }}" alt="{{ $post['judul'] }}" class="w-full">
        </figure>
      </a>
    @endif

    {!! $post['isi'] !!}

    @for($i = 1; $i <= 3; $i++) 
      @if($post['gambar'.$i] && is_file(LOKASI_FOTO_ARTIKEL.'sedang_'.$post['gambar'.$i])) 
        <a href="{{ AmbilFotoArtikel($post['gambar'.$i],'sedang') }}" class="block" data-fancybox="images">
          <figure>
            <img loading="lazy" src="{{ AmbilFotoArtikel($post['gambar'.$i],'sedang') }}" alt="{{ $post['nama'] }}" class="w-full">
          </figure>
        </a>
      @endif
    @endfor

    @if($post['dokumen']) 
      <div class="bg-slate-200 dark:bg-dark-primary py-3 px-5 border-l-4 border-secondary">
        <h4 class="text-heading text-base">Dokumen Lampiran</h4>
        <a href="{{ ci_route('first.unduh_dokumen_artikel',$post['id']) }}" class="text-link text-sm flex space-x-3 pt-2">
          <span class="ti ti-download text-secondary text-lg"></span>
          <span>{{ $post['link_dokumen'] }}</span>
        </a>
      </div>
    @endif
  </div>
  <div id="print">
    <style media="print">
      @page{size:A4;orientation:portrait}body{font-family:'Inter',sans-serif;font-size:12pt;color:#000 !important}.loading,.header,.main-nav,#sidenav,.apbdesa,#comment,.comment,#kolom-komentar,#shortcut-link,.newsticker,.sidebar,.modal,.footer,.bottom-nav,#main-css,#scroll-to-top,.print-button{display:none}.title{font-size:180%;font-family:'Poppins',sans-serif;color:#000 !important;margin-bottom:8px}.flex{display:flex;gap:10px;font-size:90%}.icon{color:teal}img{margin-top:10px;margin-bottom:10px;width:100%}table{display:block}table td{border:1px solid #ccc;border-collapse:collapse}.text-link{color:blue;text-decoration:underline}
    </style>
  </div>
  <button class="button text-xs py-1 inline-flex items-center print-button" data-mdb-ripple="true" data-mdb-ripple-color="dark" onclick="printArticle()"><i class="ti ti-printer text-lg mr-1"></i> Cetak Artikel</button>
  <span class="block font-bold">Bagikan artikel ini:</span>
  <div class="flex space-x-2">
      <a href="http://www.facebook.com/sharer.php?u={{ $post['url_slug'] }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center w-10 h-10 bg-facebook text-white rounded-full hover:ring-2 hover:ring-tertiary hover:ring-offset-2 transition duration-100">
        <i class="ti ti-brand-facebook text-xl"></i>
      </a>
      <a href="http://twitter.com/share?url={{ site_url('artikel/'.buat_slug($post))}}" target="_blank" rel="noopener" class="inline-flex items-center justify-center w-10 h-10 bg-twitter text-white rounded-full hover:ring-2 hover:ring-tertiary hover:ring-offset-2 transition duration-100">
        <i class="ti ti-brand-twitter text-xl"></i>
      </a>
      <a href="https://telegram.me/share/url?url={{ $post['url_slug'] }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center w-10 h-10 bg-telegram text-white rounded-full hover:ring-2 hover:ring-tertiary hover:ring-offset-2 transition duration-100">
        <i class="ti ti-brand-telegram text-xl"></i>
      </a>
      <a href="https://api.whatsapp.com/send?text={{ $post['url_slug'] }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center w-10 h-10 bg-whatsapp text-white rounded-full hover:ring-2 hover:ring-tertiary hover:ring-offset-2 transition duration-100">
        <i class="ti ti-brand-whatsapp text-xl"></i>
      </a>
  </div>

  @include('theme::partials.artikel.comment')
@endsection

@push('scripts')
  <script>
    function printArticle() {
      console.log('printing...')
      const iframe = document.createElement("iframe");
      iframe.style.display = "none";
      document.body.appendChild(iframe);
      const pri = iframe.contentWindow;
      pri.document.open();
      pri.document.write('<link rel="stylesheet" media="print" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Inter:wght@400;500;600;700&display=swap">');
      pri.document.write('<link rel="stylesheet" media="print" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">');
      pri.document.write(document.querySelector('#print').innerHTML);
      pri.document.write(document.querySelector('.print').innerHTML);
      pri.document.write('<p>Baca artikel online: <a href="{{ $post['url_slug'] }}" class="text-link">{{ $post['url_slug'] }}</a></p>')
      pri.document.close();
      setTimeout(() => {
        pri.focus();
        pri.print();
      }, 1500);
      pri.onafterprint = () => { document.body.removeChild(iframe); }
    }
  </script>
@endpush