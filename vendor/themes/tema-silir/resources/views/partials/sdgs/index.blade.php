@php $layout = 'full-content' @endphp
@extends('theme::layouts.master')

@section('content')
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title">
    <i class="ti ti-globe"></i> SDGs {{ ucwords(setting('sebutan_desa')) }}
  </h1>
  <div class="bg-slate-200 dark:bg-dark-primary py-3 px-5 border-l-4 border-secondary my-5 space-y-3">
    <p class="text-sm text-justify">SDGs desa adalah upaya terpadu untuk pembangunan ekonomi, sosial, lingkungan, hukum dan tata kelola masyarakat di tingkat Desa. Goals SDGs Desa diturunkan dari Goals SDGs Nasional menjadi 18 bidang fokus pembangunan. Skala skor SDGs Desa adalah 0 - 100. Semakin besar skor menunjukkan semakin tercapainya goals SDGs Desa. Selengkapnya dapat mengunjungi laman
      <a href="https://sid.kemendesa.go.id/sdgs" target="_blank" class="font-extrabold text-secondary dark:text-white">SDGs Kemendesa.</a></p>
  </div>
  <div id="errorMsg" style="display: none;">
    <div class="alert alert-danger">
        <p class="py-3" id="errorText"></p>
    </div>
  </div>


  <div class="relative border-b-4 mt-5 mb-5" id="sdgs_desa">
    <h2 class="pt-5 pb-3 px-3 text-center">
      <span class="text-heading text-5xl" id="average"><span class="text-base">@include('theme::commons.loading')</span></span></br>
      <span class="lg:text-lg text-base">Skor SDGs {{ ucwords(setting('sebutan_desa')) }}</span></br>
      <span class="text-xs bg-secondary px-5 justify-center rounded-lg" style="height:4px;"></span>
    </h2>
  </div>

  <div id="loading" class="text-heading">@include('theme::commons.loading')</div>

  <div id="sdgsData" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">
  </div>
@endsection

@push('scripts')
  <script>
    $(function () {
      $.get("{{ route('api.sdgs') }}", function (sdgs) {

        $('#loading').remove();

        if (sdgs['error_msg']) {
          $('#errorMsg').show().next('#sdgs_desa').hide();
          $('#errorText').html(data['error_msg']);
          return;
        }

        const {
          data,
          total_desa,
          average
        } = sdgs['data'][0]['attributes'];
        const path = BASE_URL + 'assets/images/sdgs/';
        $('#average').text(average);

        $('#sdgsData').empty();

        data.forEach(item => {
          const image = path + item.image;
          $('#sdgsData').append(`
              <div class="p-3 rounded-lg shadow border-gray bg-white dark:bg-dark-secondary">
                <img class="object-cover object-center" src="${image}" alt="${item.image}" />
                <div class="text-sm justify-center items-center text-center px-3 pt-3">
                  <span class="text-heading text-2xl block">${item.score}</span>
                  <span class="text-xs text-muted">NILAI</span>
                </div>
              </div>
          `);
        });
      });
    });
  </script>
@endpush