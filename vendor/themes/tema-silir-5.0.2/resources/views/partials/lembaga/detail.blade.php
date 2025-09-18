@extends('theme::layouts.master')

@section('content')
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i
      class="ti ti-building"></i> <span id="title" class="text-base text-left inline-block">...</span></h1>
  <h2 class="text-heading text-base lg:text-xl">Rinci Data <span class="data-tipe">...</span></h2>
  <div class="table-responsive main-content">
    <table class="table table-bordered table-striped w-full text-sm">
      <tbody>
        <tr>
          <td width="20%">Nama <span class="data-tipe">...</span></td>
          <td width="1%">:</td>
          <td id="detail-nama">@include('theme::commons.loading')</td>
          <td width="20%" rowspan="5" style="text-align: center; vertical-align: middle;" id="gambar_desa">
            @include('theme::commons.loading')
          </td>
        </tr>
        <tr>
          <td>Kode <span class="data-tipe">...</span></td>
          <td>:</td>
          <td id="detail-kode">@include('theme::commons.loading')</td>
        </tr>
        <tr>
          <td>Kategori <span class="data-tipe">...</span></td>
          <td>:</td>
          <td id="detail-kategori">@include('theme::commons.loading')</td>
        </tr>
        <tr>
          <td>No. SK Pendirian</td>
          <td>:</td>
          <td id="detail-no_sk_pendirian">@include('theme::commons.loading')</td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td>:</td>
          <td id="detail-keterangan">@include('theme::commons.loading')</td>
        </tr>
      </tbody>
    </table>
  </div>
  <h2 class="text-heading text-base lg:text-xl">Daftar Pengurus</h2>
  <div class="table-responsive main-content">
    <table class="table table-bordered table-striped w-full text-sm" id="tabel-pengurus">
      <thead>
        <tr>
          <th>No</th>
          <th>Jabatan</th>
          <th>Nama</th>
          <th>Alamat</th>
        </tr>
      </thead>
      <tbody>
        <tr><td colspan="4">@include('theme::commons.loading')</td></tr>
      </tbody>
    </table>
  </div>

  <h2 class="text-heading text-base lg:text-xl">Daftar Anggota</h2>
  <div class="table-responsive main-content">
    <table class="table table-bordered table-striped w-full text-sm" id="tabel-anggota">
      <thead>
        <tr>
          <th>No</th>
          <th>No. Anggota</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Jenis Kelamin</th>
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
      const route = "{{ route('api.' . $tipe . '.detail', ['slug' => $slug]) }}";
      $.ajax({
        url: route,
        method: 'GET',
        success: function (data) {
          const detail = data.data.attributes;
          const pengurus = detail.pengurus;
          const tipe = detail.tipe;
          const gambar_desa = `{{ gambar_desa('${detail.logo}') }}`;

          $('#title').removeClass('text-base text-left inline-block').html(`Data ${tipe} ${detail.nama}`)
          $('.data-tipe').removeClass('text-base inline-block text-left').html(tipe)
          $('#detail-nama').html(detail.nama)
          $('#detail-kode').html(detail.kode)
          $('#detail-kategori').html(detail.kategori)
          $('#detail-no_sk_pendirian').html(detail.no_sk_pendirian)
          $('#detail-keterangan').html(detail.keterangan)
          $('#gambar_desa').html(`<img src="${gambar_desa}" class="w-full" alt="logo"/>`)

          var pengurusElemen = '';

          pengurus.forEach((data, key) => {
            pengurusElemen += `
                        <tr>
                          <td>${key + 1}</td>
                          <td>${data.nama_jabatan}</td>
                          <td nowrap>${data.nama_penduduk}</td>
                          <td>${data.alamat_lengkap}</td>
                        </tr>`;
          });

          $('#tabel-pengurus tbody').html(pengurusElemen)

          anggotaTable();
        },
        error: function (xhr) {
          console.error('AJAX Error:', xhr.responseText);
          Swal.fire('Error', 'Terjadi kesalahan saat memuat data.', 'error');
        }
      });

      const anggotaTable = () => {
        $('#tabel-anggota').DataTable({
          processing: true,
          serverSide: true,
          autoWidth: false,
          ordering: true,
          ajax: {
            url: `{{ route('api.'.$tipe.'.anggota', ['slug' => $slug]) }}`,
            method: 'get',
            data: function (row) {
              return {
                "page[size]": row.length,
                "page[number]": (row.start / row.length) + 1,
                "filter[search]": row.search.value,
                "sort": `${row.order[0]?.dir === "asc" ? "" : "-"}${row.columns[row.order[0]?.column]?.name}`,
              };
            },
            dataSrc: function (json) {
              json.recordsTotal = json.meta.pagination.total
              json.recordsFiltered = json.meta.pagination.total

              return json.data
            },
            error: function(xhr) {
              console.error('AJAX Error:', xhr.responseText);
              Swal.fire('Error', 'Terjadi kesalahan saat memuat data.', 'error');
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
              data: 'no_anggota',
              name: 'no_anggota',
              render: (data, type, row) => row.attributes.no_anggota
            },
            {
              data: 'nama',
              name: 'nama',
              className: 'text-wrap',
              render: (data, type, row) => row.attributes.anggota.nama
            },
            {
              data: 'alamat',
              name: 'alamat',
              render: (data, type, row) => row.attributes.alamat_lengkap
            },
            {
              data: 'jenis_kelamin',
              name: 'jenis_kelamin',
              render: (data, type, row) => row.attributes.sex
            },
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
      }
    });
  </script>
@endpush