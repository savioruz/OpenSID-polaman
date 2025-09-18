<section class="slider -mx-3 lg:mx-auto lg:mt-0">
  <div class="owl-carousel slider-content">
    @foreach($slider_gambar['gambar'] as $data)
      @php $img = $slider_gambar['lokasi'] . 'sedang_' . $data['gambar']; @endphp
      @if(is_file($img) or filter_var($data['gambar'], FILTER_VALIDATE_URL) !== false) 
        @php $img_src = is_file($img) ? base_url($img) : $data['gambar'] @endphp
        <figure class="slider-item">
          <img loading="lazy" src="{{ $img_src }}" alt="{{ $data['judul'] }}" class="slider-image">
          <figcaption class="absolute block bottom-0 p-3 lg:p-5 text-sm bg-gradient-to-b from-black/40 to-black/70 w-full h-auto text-white z-[999] left-0 right-0 font-heading lg:text-xl font-bold tracking-wide">
            {{ $data['judul'] }}
        </figure>
      @endif
    @endforeach
  </div>
  <!-- <ul class="slider-nav">
    <li class="slider-nav-item slider-nav-prev"><span data-feather="chevron-left" class="icon"></span></li>
    <li class="slider-nav-item slider-nav-next"><span data-feather="chevron-right" class="icon"></span></li>
  </ul> -->
</section>