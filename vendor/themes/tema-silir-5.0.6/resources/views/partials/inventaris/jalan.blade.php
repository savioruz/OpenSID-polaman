@php $layout = 'full-content' @endphp
@extends('theme::layouts.master')
@extends('admin.layouts.components.asset_numeral')

@section('content')
  <div class="main-content space-y-4">
    <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i
        class="ti ti-road"></i> {{ $judul }}</h1>
    <a href="{{ site_url('inventaris') }}" class="button button-tertiary text-sm"><i class="ti ti-chevron-left"></i> Kembali ke Daftar Inventaris</a>
    <div class="table-responsive overflow-auto w-full">
      <table class="table table-striped table-bordered dataTable" id="inventaris">
        <thead>
          <tr>
            <th class="text-center" rowspan="2">No</th>
            <th class="text-center" rowspan="2">Nama Barang</th>
            <th class="text-center" rowspan="2">Kode Barang / Nomor Registrasi</th>
            <th class="text-center" rowspan="2">Kondisi (B, KB, RB)</th>
            <th class="text-center" rowspan="2">Jenis Konstruksi</th>
            <th class="text-center" rowspan="2">Luas (M<sup>2</sup>)</th>
            <th class="text-center" colspan="2">Dokumen Kepemilikan</th>
            <th class="text-center" rowspan="2">Status Tanah</th>
            <th class="text-center" rowspan="2">Asal Usul</th>
            <th class="text-center" rowspan="2">Harga (Rp)</th>
          </tr>
          <tr>
            <th class="text-center" style="text-align:center;" rowspan="1">Tanggal</th>
            <th class="text-center" style="text-align:center;" rowspan="1">Nomor</th>
          </tr>
        </thead>
        <tbody id="inventaris-tbody">
          <tr><td colspan="11">@include('theme::commons.loading')</td></tr>
        </tbody>

        <tfoot id="inventaris-tfoot">
          <tr>
            <th colspan="10" class="text-right">Total:</th>
            <th class="total"></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      const _url = `{{ ci_route('internal_api.inventaris-jalan') }}`
      const _tbody = document.getElementById('inventaris-tbody')
      const _tfoot = document.getElementById('inventaris-tfoot')
      $.ajax({
        url: _url,
        type: 'GET',
        success: (response) => {
          let _trString = []
          let _total = 0
          _tbody.innerHTML = '';
          if (response.data.length) {
            response.data.forEach((element, key) => {
              _trString.push(`<tr>
                  <td>${key + 1}</td>
                  <td>${element.attributes.nama_barang}</td>
                  <td>${element.attributes.kode_barang}<br>${element.attributes.register}</td>
                  <td>${element.attributes.kondisi}</td>
                  <td>${element.attributes.konstruksi}</td>
                  <td>${element.attributes.luas}</td>
                  <td>${element.attributes.tanggal_dokument}</td>
                  <td>${element.attributes.no_dokument}</td>
                  <td>${element.attributes.status_tanah}</td>
                  <td>${element.attributes.asal}</td>
                  <td>${element.attributes.harga_format}</td>
                </tr>`)
              _total += element.attributes.harga
            });
            _tfoot.querySelector(`th.total`).innerHTML = numeral(_total).format()
            _tbody.innerHTML = _trString.join('')
          } else {
            _tfoot.remove()
            _tbody.innerHTML = ''
          }

          $('#inventaris').DataTable({
            columnDefs: [{
              targets: [0],
              orderable: false
            }],
            order: [
              [1, 'asc']
            ]
          });
        },
        dataType: 'json'
      })
    });
  </script>
@endpush