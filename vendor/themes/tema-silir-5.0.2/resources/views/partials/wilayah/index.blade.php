@extends('theme::template')
@include('theme::commons.globals')

@section('layout')
  @include('theme::commons.header')
  @include('theme::commons.main_nav')

  <section class="container px-3 max-w-container mx-auto space-y-5 my-5">
    @include('theme::partials.newsticker')

    <div class="content-wrapper my-5 flex-col-reverse lg:flex-row">
      <aside class="lg:w-1/4 lg:sticky top-14 w-full">
        @include('theme::partials.statistik.sidenav')
      </aside>
      <main class="card content main-content lg:w-3/4">
        <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title">Demografi Berdasarkan Wilayah</h1>
        <div class="bg-slate-200 dark:bg-dark-primary py-3 px-5 border-l-4 border-secondary my-5 space-y-3">
          <p class="text-sm text-justify">{{ $heading }}</p>
        </div>

        <div class="table-responsive py-3">
          <table class="w-full text-sm" id="tabelData">
            <thead>
              <tr>
                <th>No</th>
                <th colspan="8">Wilayah / Ketua</th>
                <th class="text-center">KK</th>
                <th class="text-center">L+P</th>
                <th class="text-center">L</th>
                <th class="text-center">P</th>
              </tr>
            </thead>
            <tbody>
              <tr><td colspan="13">@include('theme::commons.loading')</td></tr>
            </tbody>
          </table>
        </div>
      </main>
    </div>
    @include('theme::widgets.shortcut_links')
  </section>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      const tabelData = $('#tabelData');
      let wilayahHTML = '';

      function loadWilayah() {

        const routeWilayah = '{{ route("api.wilayah.administratif") }}';

        $.get(routeWilayah, function (response) {

          const wilayah = response.data;

          tabelData.find('tbody').empty();
          tabelData.find('tfoot').empty();

          if (!wilayah.length) {
            tabelData.find('tbody').append(`<tr><td colspan="13" class="text-center">Tidak ada data wilayah yang tersedia</td></tr>`);
            return;
          }

          loadDusun(wilayah);
        });
      }

      // Tingkat 1 : Dusun
      function loadDusun(data) {
        let no = 1;
        let totalKK = 0;
        let totalPriaWanita = 0;
        let totalPria = 0;
        let totalWanita = 0;

        data.forEach(function (item, index) {
          var row = `<tr>
                <td class="text-center">${no}</td>
                <td colspan="8">${item.attributes.sebutan_dusun + ' ' + item.attributes.dusun + item.attributes.kepala_nama}</td>
                <td class="text-right">${item.attributes.keluarga_aktif_count}</td>
                <td class="text-right">${item.attributes.penduduk_pria_wanita_count}</td>
                <td class="text-right">${item.attributes.penduduk_pria_count}</td>
                <td class="text-right">${item.attributes.penduduk_wanita_count}</td>
              </tr>`;

          wilayahHTML += row;
          totalKK += item.attributes.keluarga_aktif_count;
          totalPriaWanita += item.attributes.penduduk_pria_wanita_count;
          totalPria += item.attributes.penduduk_pria_count;
          totalWanita += item.attributes.penduduk_wanita_count;
          no++;

          loadRW(item.attributes.rws);
        });

        tabelData.find('tbody').append(wilayahHTML);

        let totalPW = totalPria + totalWanita;
        var tfoot = `<tr class="font-bold">
          <td class="text-center" colspan="9">TOTAL</td>
          <td class="text-right">${totalKK}</td>
          <td class="text-right">${totalPW}</td>
          <td class="text-right">${totalPria}</td>
          <td class="text-right">${totalWanita}</td>
        </tr>`;

        tabelData.find('tbody').after(tfoot);
      }

      // Tingkat 2 : RW
      function loadRW(data) {
        let no = 1;

        data.forEach(function (item) {
          if (item.rw !== '-') {
            let row = `
              <tr>
                <td></td>
                <td class="text-center">${no}</td>
                <td colspan="7">${item.sebutan_rw + ' ' + item.rw + item.kepala_nama}</td>
                <td class="text-right">${item.keluarga_aktif_count}</td>
                <td class="text-right">${item.penduduk_pria_wanita_count}</td>
                <td class="text-right">${item.penduduk_pria_count}</td>
                <td class="text-right">${item.penduduk_wanita_count}</td>
              </tr>`;

            wilayahHTML += row;
            no++;
          }

          loadRT(item.rw, item.rts);
        });
      }

      // Tingkat 3 : RT
      function loadRT(rw, data) {
        let no = 1;

        data.forEach(function (item) {
          if (rw == item.rw && item.rt !== '-') {
            let row = `
                  <tr>
                    <td></td>
                    <td></td>
                    <td class="text-center">${no}</td>
                    <td colspan="6">${item.sebutan_rt + ' ' + item.rt + item.kepala_nama}</td>
                    <td class="text-right">${item.keluarga_aktif_count}</td>
                    <td class="text-right">${item.penduduk_pria_wanita_count}</td>
                    <td class="text-right">${item.penduduk_pria_count}</td>
                    <td class="text-right">${item.penduduk_wanita_count}</td>
                  </tr>`;

            wilayahHTML += row;
            no++;
          }
        });
      }

      loadWilayah();
    });
  </script>
@endpush