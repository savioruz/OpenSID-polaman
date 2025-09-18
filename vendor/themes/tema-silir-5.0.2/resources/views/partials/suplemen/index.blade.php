@extends('theme::layouts.master')

@section('content')
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i
      class="ti ti-clipboard-list"></i> <span id="judul">...</span></h1>

  <h2 class="text-heading text-base lg:text-xl">Rincian Data Suplemen</h2>

  <div class="table-responsive main-content">
    <table class="table-striped table-bordered">
      <tbody>
        <tr>
          <td width="20%">Nama Data</td>
          <td width="1%">:</td>
          <td id="nama">@include('theme::commons.loading')</td>
        </tr>
        <tr>
          <td>Sasaran Terdata</td>
          <td>:</td>
          <td id="sasaran">@include('theme::commons.loading')</td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td>:</td>
          <td id="keterangan">@include('theme::commons.loading')</td>
        </tr>
      </tbody>
    </table>
  </div>
  <h2 class="text-heading text-base lg:text-xl">Daftar Terdata</h2>
  <div class="table-responsive main-content">
    <table class="w-full text-sm table-striped table-bordered dataTable" id="tabelData">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Tempat Lahir</th>
          <th>Jenis-kelamin</th>
          <th>Alamat</th>
        </tr>
      </thead>
      <tbody>
        <tr><td colspan="5">@include('theme::commons.loading')</td></tr>
      </tbody>
    </table>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('js/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('scripts')
  <script src="{{ asset('js/sweetalert2/sweetalert2.all.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      var apiSuplemen = `{{ route('api.suplemen') }}`;
      var params = {
        "filter[slug]": `{{ $slug }}`,
      };

      $.get(apiSuplemen, params, function (response) {
        suplemen = response.data[0];

        if (!suplemen) {
          Swal.fire("Error", "Data tidak ditemukan.", "error");
          return;
        }

        $("#judul").text("Data Suplemen " + suplemen.attributes.nama);
        $("#nama").text(suplemen.attributes.nama);
        $("#sasaran").text(suplemen.attributes.nama_sasaran);
        $("#keterangan").text(suplemen.attributes.keterangan);

        loadAnggota(suplemen.id);
      });

      function loadAnggota(id) {
        var routeSuplemenAnggota = `{{ route('api.suplemen') }}` + "/" + id;

        var tabelData = $("#tabelData").DataTable({
          processing: true,
          serverSide: true,
          autoWidth: false,
          ordering: true,
          ajax: {
            url: routeSuplemenAnggota,
            method: "GET",
            data: (row) => ({
              "page[size]": row.length,
              "page[number]": row.start / row.length + 1,
              "filter[search]": row.search.value,
              sort: `${row.order[0]?.dir === "asc" ? "" : "-"}${
                row.columns[row.order[0]?.column]?.name
              }`,
            }),
            dataSrc: (json) => {
              json.recordsTotal = json.meta.pagination.total;
              json.recordsFiltered = json.meta.pagination.total;
              return json.data;
            },
            error: function (xhr) {
              console.error("AJAX Error:", xhr.responseText);
              Swal.fire("Error", "Terjadi kesalahan saat memuat data.", "error");
            },
          },
          columnDefs: [
            {
              targets: "_all",
              className: "text-nowrap",
            },
          ],
          columns: [
            {
              data: null,
              searchable: false,
              orderable: false,
              className: "text-center",
            },
            {
              data: "attributes.terdata_nama",
              name: "tweb_penduduk.nama",
            },
            {
              data: "attributes.tempatlahir",
              name: "tweb_penduduk.tempatlahir",
            },
            {
              data: "attributes.sex",
              name: "tweb_penduduk.sex",
            },
            {
              data: "attributes.alamat",
              name: "tweb_penduduk.alamat",
              orderable: false,
            },
          ],
          order: [[1, "asc"]],
          drawCallback: function (settings) {
            var api = this.api();
            api
              .column(0, {
                search: "applied",
                order: "applied",
              })
              .nodes()
              .each(function (cell, i) {
                cell.innerHTML = api.page.info().start + i + 1;
              });
          },
        });
      }
    });
  </script>
@endpush