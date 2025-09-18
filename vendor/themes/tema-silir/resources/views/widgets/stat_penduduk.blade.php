<div class="lg:w-5/12 mx-auto w-full px-5 py-6 space-y-8" data-aos="fade-zoom-in">
  <h2 class="text-center text-xl font-bold font-heading">Statistik Penduduk {{ $nama_desa }}</h2>
  <div class="grid grid-cols-3">
    <div class="text-center space-y-1">
      <img src="{{ theme_asset('images/man.png') }}" class="w-16 mx-auto" alt="Laki-laki">
      <div class="counter text-2xl font-bold pt-2" data-target="{{ $stat_widget[0]['jumlah'] }}"></div>
      <p class="text-sm">Laki-laki</p>
    </div>
    <div class="text-center space-y-1">
      <img src="{{ theme_asset('images/woman.png') }}" class="w-16 mx-auto" alt="Perempuan">
      <div class="counter text-2xl font-bold pt-2" data-target="{{ $stat_widget[1]['jumlah'] }}"></div>
      <p class="text-sm">Perempuan</p>
    </div>
    <div class="text-center space-y-1">
      <img src="{{ theme_asset('images/family.png') }}" class="w-16 mx-auto" alt="Jumlah Penduduk">
      <div class="counter text-2xl font-bold pt-2" data-target="{{ $stat_widget[2]['jumlah'] }}"></div>
      <p class="text-sm">Jumlah penduduk</p>
    </div>
  </div>
</div>