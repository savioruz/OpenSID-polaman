
@php
  $data = array(
    array(
      "type" => "confirmed",
      "bg" => "bg-red-600",
      "emoji" => "emoji-sad.png",
      "label" => "Positif"
    ),
    array(
      "type" => "recovered",
      "bg" => "bg-emerald-600",
      "emoji" => "emoji-happy.png",
      "label" => "Sembuh"
    ),
    array(
      "type" => "deaths",
      "bg" => "bg-purple-600",
      "emoji" => "emoji-cry.png",
      "label" => "Meninggal"
    )
  );
  $odp = $covid[0]; //"Orang Dalam Pemantauan (ODP)" => "ODP",
  $pdp = $covid[1]; //"Pasien Dalam Pengawasan (PDP)" => "PDP",
  $odr = $covid[2]; //"Orang Dalam Resiko (ODR)" => "ODR"
  $otg = $covid[3]; //"Orang Tanpa Gejala (OTG)" => "OTG",
  $positif = $covid[4]; //"Positif Covid-19" => "POSITIF",
@endphp

<button class="relative w-full text-center covid-heading button-transparent bg-secondary rounded-lg cursor-pointer overflow-hidden">
  <div class="py-2 space-y-3">
    <h3 class="lg:text-lg font-bold font-heading inline-block text-white">Live Data COVID-19</h3>
    <span class="absolute inline-flex top-0 h-4 w-4 items-center justify-center">
      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
      <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
    </span>
  </div>
  <div class="covid-wrapper transition-all duration-200 @php @$hide_covid19 && print('hide-in-small') }}">
    @if(setting('covid_desa')) 
      <div class="w-full grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4 p-3 lg:p-4 shadow bg-white dark:bg-dark-secondary">
        <div class="w-full text-white bg-orange-500 p-4 rounded-lg shadow">
          <div class="w-full flex flex-row space-x-4 items-center text-left">
            <div class="w-10 h-auto flex-shrink-0 hidden lg:inline-block">
              <img loading="lazy" src="{{ theme_asset('images/corona.png') }}" alt="emoji">
            </div>
            <div class="flex-1 space-y-2 py-1">
              <h6 class="font-extrabold w-full lg:text-lg">Data Kasus COVID-19 <span class="hidden lg:inline-block"> di {{ ucwords(setting('sebutan_desa')); }} {{ $desa['nama_desa']; }}</span></h6>
            </div>
          </div>
        </div> 
        <div class="w-full text-white bg-red-500 p-4 rounded-lg shadow">
          <div class="w-full flex flex-row space-x-4 items-center text-left">
            <div class="w-12 h-auto flex-shrink-0 hidden lg:inline-block">
              <img loading="lazy" src="{{ theme_asset('images/emoji-sad.png') }}" alt="emoji">
            </div>
            <div class="flex-1 space-y-2 py-1 text-sm">Positif Covid-19
              <p class="text-heading font-extrabold w-full text-2xl">{{ number_format($positif['jumlah']); }}
                <span class="text-sm font-normal inline-block">Orang</span>
              </p>
            </div>
          </div>
        </div>
        <div class="w-full text-white bg-red-500 p-4 rounded-lg shadow">
          <div class="w-full flex flex-row space-x-4 items-center text-left">
            <div class="w-12 h-auto flex-shrink-0 hidden lg:inline-block">
              <img loading="lazy" src="{{ theme_asset('images/emoji-sad.png') }}" alt="emoji">
            </div>
            <div class="flex-1 space-y-2 py-1 text-sm">Pasien Dalam Pengawasan
              <p class="text-heading font-extrabold w-full text-2xl">{{ number_format($pdp['jumlah']); }}
                <span class="text-sm font-normal inline-block">Orang</span>
              </p>
            </div>
          </div>
        </div>
        <div class="w-full text-white bg-red-500 p-4 rounded-lg shadow">
          <div class="w-full flex flex-row space-x-4 items-center text-left">
            <div class="w-12 h-auto flex-shrink-0 hidden lg:inline-block">
              <img loading="lazy" src="{{ theme_asset('images/emoji-sad.png') }}" alt="emoji">
            </div>
            <div class="flex-1 space-y-2 py-1 text-sm">Orang Dalam Pemantauan
              <p class="text-heading font-extrabold w-full text-2xl">{{ number_format($odp['jumlah']); }}
                <span class="text-sm font-normal lg:inline-block">Orang</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    @endif
  </div>
</button>