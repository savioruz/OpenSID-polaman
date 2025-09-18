@extends('theme::layouts.master')

@section('content')
  <section class="main-content space-y-2">
    <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i
        class="ti ti-report-analytics"></i> Daftar Agregasi Data Analisis {{ ucwords(setting('sebutan_desa')) }}</h1>
    <div class="space-y-1 flex gap-3 items-center pt-2">
      <label for="master" class="block">Analisis</label>
      <select class="form-input inline-block w-auto" style="min-width: 100px" id="master" name="master"></select>
    </div>
    <div class="table-responsive py-2">
      <table class="table table-bordered table-striped">
        <tbody>
          <tr>
            <td width="200">Pendataan </td>
            <td width="20">:</td>
            <td id="pendataan-detail">@include('theme::commons.loading')</td>
          </tr>
          <tr>
            <td>Subjek </td>
            <td>:</td>
            <td id="subjek-detail">@include('theme::commons.loading')</td>
          </tr>
          <tr>
            <td>Tahun </td>
            <td>:</td>
            <td id="tahun-detail">@include('theme::commons.loading')</td>
          </tr>
        </tbody>
      </table>
    </div>
    <h2 class="text-heading text-base lg:text-xl">Indikator</h2>
    <div class="table-responsive">
      <table class="table table-striped table-bordered dataTable" id="table-indikator">
        <thead>
          <tr>
            <th width="3%">No.</th>
            <th width="93%">Indikator</th>
          </tr>
        </thead>
        <tbody>
          <tr><td colspan="2">@include('theme::commons.loading')</td></tr>
        </tbody>
      </table>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      var routeApiMaster = '{{ route('api.analisis.master') }}';

      $.get(routeApiMaster, function (data) {
        const $masterSelect = $('#master');

        $('#pendataan-detail').html('-')
        $('#subjek-detail').html('-');
        $('#tahun-detail').html('-');

        data.data.forEach(item => {
          $masterSelect.append(`<option value="${item.id}">${item.attributes.master} (${item.attributes.tahun})</option>`);
        });

        $masterSelect.on('change', function () {
          const selectedId = $(this).val();
          const selectedItem = data.data.find(item => item.id === selectedId);

          if (selectedItem) {
            $('#pendataan-detail').html(selectedItem.attributes.master || 'N/A');
            $('#subjek-detail').html(selectedItem.attributes.subjek || 'N/A');
            $('#tahun-detail').html(selectedItem.attributes.tahun || 'N/A');
          }
        });

        const firstItem = data.data[0];
        if (firstItem) {
          $('#pendataan-detail').html(firstItem.attributes.master || 'N/A');
          $('#subjek-detail').html(firstItem.attributes.subjek || 'N/A');
          $('#tahun-detail').html(firstItem.attributes.tahun || 'N/A');

          $masterSelect.val(firstItem.id).trigger('change');
        }
      });

      var routeApiIndikator = '{{ route('api.analisis.indikator') }}';

      var tabelData = $('#table-indikator').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        ordering: false,
        searching: false,
        ajax: {
          url: routeApiIndikator,
          method: 'GET',
          data: row => ({
            "filter[id_master]": $('#master').val(),
            "page[size]": row.length,
            "page[number]": (row.start / row.length) + 1,
          }),
          dataSrc: json => {
            json.recordsTotal = json.meta.pagination.total;
            json.recordsFiltered = json.meta.pagination.total;
            return json.data;
          },
          error: function (xhr) {
            console.error('AJAX Error:', xhr.responseText);
          }
        },
        columnDefs: [{
          targets: '_all',
          className: 'text-nowrap'
        }, ],
        columns: [{
            data: null,
            searchable: false,
            orderable: false
          },
          {
            data: 'attributes.indikator',
            name: 'attributes.indikator',
            render: (data, type, row) => {
              const url = `/jawaban_analisis?filter[id_indikator]=${row.id}&filter[subjek_tipe]=${row.attributes.subjek_tipe}&filter[id_periode]=${row.attributes.id_periode}`;
              return `<a href="${url}" class="font-semibold">${row.attributes.indikator}</a>`;
            }
          }
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

      $('#master').on('change', function () {
        tabelData.ajax.reload();
      });
    });
  </script>
@endpush