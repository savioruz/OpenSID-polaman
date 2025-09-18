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
        <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title">
        Demografi Berdasarkan Hak Pilih</h1>
        <div class="bg-slate-200 dark:bg-dark-primary py-3 px-5 border-l-4 border-secondary my-5 space-y-3">
          <p class="text-sm text-justify">{{ $heading }}</p>
        </div>

        <div class="table-responsive overflow-auto w-full py-1">
          <table class="w-full text-sm">
            <thead>
              <tr>
                <th>No</th>
                <th>{{ ucwords(setting('sebutan_dusun')) }}</th>
                <th>RW</th>
                <th>Jiwa</th>
                <th>Lk</th>
                <th>Pr</th>
              </tr>
            </thead>
            <tbody id="dpt-tbody">

            </tbody>
            <tfoot id="dpt-tfoot">
              <tr class="font-bold">
                <td colspan="3" class="text-left">TOTAL</td>
                <td class="total text-right"></td>
                <td class="total_lk text-right"></td>
                <td class="total_pr text-right"></td>
              </tr>
            </tfoot>
          </table>
        </div>

        <p class="text-sm text-slate-500 py-1">
          Tanggal Pemilihan : {{ $tanggal_pemilihan }}
        </p>
      </main>
    </div>
    @include('theme::widgets.shortcut_links')
  </section>
@endsection

@push('scripts')
  @include('admin.layouts.components.asset_numeral')

  <script>
    $(function () {
      const _url = `{{ ci_route('internal_api.dpt') }}?tgl_pemilihan={{ $tanggal_pemilihan }}`
      const _tbody = document.getElementById('dpt-tbody')
      const _tfoot = document.getElementById('dpt-tfoot')
      $.ajax({
        url: _url,
        type: 'GET',
        beforeSend: () => {
          _tbody.innerHTML = `<tr><td colspan="6">@include('theme::commons.loading')</td></tr>`;
        },
        success: (response) => {
          let _trString = []
          let _total = {
            'laki': 0,
            'perempuan': 0
          }
          if (response.data.length) {
            const groupedData = groupingData(response.data)
            groupedData.forEach((element, key) => {
              _trString.push(`<tr>
                                <td class="text-center">${key + 1}</td>
                                <td>${element.dusun}</td>
                                <td class="text-center">${element.rw}</td>
                                <td class="text-right">${element.totalLaki + element.totalPerempuan}</td>
                                <td class="text-right">${element.totalLaki}</td>
                                <td class="text-right">${element.totalPerempuan}</td>
                            </tr>`)
              _total['laki'] += element.totalLaki
              _total['perempuan'] += element.totalPerempuan
            });
            _tfoot.querySelector(`td.total`).innerHTML = numeral(_total['laki'] + _total['perempuan']).format('0,0')
            _tfoot.querySelector(`td.total_lk`).innerHTML = numeral(_total['laki']).format('0,0')
            _tfoot.querySelector(`td.total_pr`).innerHTML = numeral(_total['perempuan']).format('0,0')
            _tbody.innerHTML = _trString.join('')
          } else {
            _tfoot.remove()
            _tbody.innerHTML = '<tr><td colspan="6">Daftar masih kosong</td></tr>'
          }
        },
        dataType: 'json'
      })

      const groupingData = function (inputData) {
        let groupedData = []
        inputData.forEach(item => {
          const dusun = item.attributes.dusun;
          const rw = item.attributes.rw;
          const sex = item.attributes.sex;
          const total = item.attributes.total;

          const key = `${dusun}-${rw}`;

          if (!groupedData[key]) {
            groupedData[key] = {
              dusun: dusun,
              rw: rw,
              totalLaki: 0,
              totalPerempuan: 0
            };
          }

          if (sex === 1) {
            groupedData[key].totalLaki += total;
          } else if (sex === 2) {
            groupedData[key].totalPerempuan += total;
          }
        });

        return Object.values(groupedData);
      }
    });
  </script>
@endpush