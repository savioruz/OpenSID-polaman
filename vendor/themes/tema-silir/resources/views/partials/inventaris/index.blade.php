@php $layout = 'full-content' @endphp
@extends('theme::layouts.master')

@section('content')
  <div class="main-content space-y-3">
    <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i
        class="ti ti-building-warehouse"></i> Inventaris</h1>
    <div class="table-responsive overflow-auto w-full">
      <table class="table table-striped table-bordered dataTable" id="inventaris">
        <thead>
          <tr>
          <tr>
            <th class="text-center" rowspan="3" style="vertical-align: middle;">No</th>
            <th class="text-center" rowspan="3" style="vertical-align: middle;">Jenis Barang</th>
            <th class="text-center" rowspan="3" style="min-width:350px;vertical-align: middle;">Keterangan</th>
            <th class="text-center" colspan="5" style="vertical-align: middle;">Asal barang</th>
            <th class="text-center" rowspan="3" style="vertical-align: middle;">Aksi</th>
          </tr>
          <tr>
            <th class="text-center" rowspan="2">Dibeli Sendiri</th>
            <th class="text-center" colspan="3">Bantuan</th>
            <th class="text-center" style="text-align:center;" rowspan="2">Sumbangan</th>
          </tr>
          <tr>
            <th class="text-center">Pemerintah</th>
            <th class="text-center">Provinsi</th>
            <th class="text-center">Kabupaten</th>
          </tr>
          </tr>
        </thead>
        <tbody id="inventaris-tbody">
          <tr>
            <td colspan="10">@include('theme::commons.loading')</td>
          </tr>
        </tbody>

        <tfoot id="inventaris-tfoot">
          <tr>
            <th colspan="3" class="text-center">Total</th>
            <th class="pribadi"></th>
            <th class="pemerintah"></th>
            <th class="provinsi"></th>
            <th class="kabupaten"></th>
            <th class="sumbangan"></th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      const _url = `{{ ci_route('internal_api.inventaris') }}`
      const _tbody = document.getElementById('inventaris-tbody')
      const _tfoot = document.getElementById('inventaris-tfoot')
      $.ajax({
        url: _url,
        type: 'GET',
        success: (response) => {
          let _trString = []
          let _total = {
            'pribadi': 0,
            'pemerintah': 0,
            'provinsi': 0,
            'kabupaten': 0,
            'sumbangan': 0
          }
          _tbody.innerHTML = '';
          response.data[0].attributes.forEach((element, key) => {
            _trString.push(`<tr>
                  <td>${key + 1}</td>
                  <td>${element.jenis}</td>
                  <td>${element.ket}</td>
                  <td>${element.pribadi}</td>
                  <td>${element.pemerintah}</td>
                  <td>${element.provinsi}</td>
                  <td>${element.kabupaten}</td>
                  <td>${element.sumbangan}</td>
                  <td>
                      <div class="text-sm" role="group" aria-label="...">
                        <a href="${element.url}" title="Lihat Data" type="button" class="button button-secondary"><i class="ti ti-eye"></i></a>
                      </div>
                  </td>
              </tr>`)
            for (let i in _total) {
              _total[i] += element[i]
            }
          });
          for (let i in _total) {
            _tfoot.querySelector(`th.${i}`).innerHTML = _total[i]
          }
          _tbody.innerHTML = _trString.join('')

          
          $('#inventaris').DataTable({
            columnDefs: [{
              targets: [0, 8],
              orderable: false
            }],
            order: [
              [1, 'asc']
            ],
            drawCallback: function (settings) {
              var api = this.api();
              api.column(0, {
                search: 'applied',
                order: 'applied'
              }).nodes().each(function (cell, i) {
                cell.innerHTML = api.page.info().start + i + 1;
              });
            }
          });
        },
        dataType: 'json'
      })
    });
  </script>
@endpush