<section class="relative overflow-hidden shadow-lg rounded-lg @php $is_home and print('my-5') @endphp">
  <div class="product-header">
    <h3 class="text-heading product-ribbon">Aparatur</h3>
  </div>
  <div class="owl-carousel flex space-x-4 bg-primary dark:bg-dark-primary p-4 {{ $is_home ? 'main-carousel' :'one-carousel' }}">
    @foreach($aparatur_desa['daftar_perangkat'] as $data) 
      <div class="card p-4 flex flex-col justify-between space-y-4 product-item">
        <div class="space-y-3">
          <img loading="lazy" src="{{ $data['foto'] }}" alt="{{ $data['nama'] }}" class="w-full object-cover object-center bg-slate-300 dark:bg-slate-600 mx-auto rounded-lg" style="@php !$is_home and print('width: 65%') @endphp">
          <div class="space-y-1 text-sm text-center">
            <span class="text-heading">{{ $data['nama'] }}</span>
            <span class="block">{{ $data['jabatan'] }}</span>
            @if($data['pamong_niap']) 
              <span class="block">{{ setting('sebutan_nip_desa') }} : {{ $data['pamong_niap'] }}</span>
            @endif
            @if($data['kehadiran'] == 1) 
              @if(setting('tampilkan_kehadiran') && $data['status_kehadiran'] == 'hadir') 
                  <span class="bg-emerald-500 text-white py-1 px-3 rounded inline-block">Hadir</span>
                  @elseif (setting('tampilkan_kehadiran') && $data['tanggal'] == date('Y-m-d') && $data['status_kehadiran'] != 'hadir') 
                      <span class="bg-red-500 text-white py-1 px-3 rounded inline-block">{{ ucwords($data['status_kehadiran']) }}</span>
                  @elseif (setting('tampilkan_kehadiran') && $data['tanggal'] != date('Y-m-d')) 
                      <span class="bg-red-500 text-white py-1 px-3 rounded inline-block">Belum Rekam Kehadiran</span>
              @endif
            @endif
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>
