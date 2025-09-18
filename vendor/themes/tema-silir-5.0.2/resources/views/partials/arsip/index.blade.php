@extends('theme::layouts.master')

@section('content')
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i
      class="ti ti-archive"></i> Arsip Konten Situs Web {{ $desa['nama_desa'] }}</h1>
  <div class="table-responsive main-content">
    <table id="arsip-artikel" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th width="3%">No.</th>
          <th width="20%">Tanggal Artikel</th>
          <th width="57">Judul Artikel</th>
          <th width="10%">Penulis</th>
          <th width="10%">Dibaca</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      const arsip = $('#arsip-artikel').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        ordering: true,
        ajax: {
          url: `{{ ci_route('internal_api.arsip') }}`,
          method: 'get',
          data: function (row) {
            return {
              "page[size]": row.length,
              "page[number]": (row.start / row.length) + 1,
              "filter[search]": row.search.value,
              "sort": (row.order[0]?.dir === "asc" ? "" : "-") + row.columns[row.order[0]?.column]?.name,
            };
          },
          dataSrc: function (json) {
            json.recordsTotal = json.meta.pagination.total
            json.recordsFiltered = json.meta.pagination.total

            return json.data
          },
        },
        columnDefs: [{
          targets: '_all',
          className: 'text-nowrap',
        }, ],
        columns: [{
            data: null,
            orderable: false
          },
          {
            data: "attributes.tgl_upload_local",
            name: "tgl_upload"
          },
          {
            data: function (data) {
              return `<a href="${data.attributes.url_slug}">
                                ${data.attributes.judul}
                            </a>`
            },
            name: "judul",
            orderable: false
          },
          {
            data: "attributes.author.nama",
            name: "id_user",
            defaultContent: '',
            searchable: false,
            orderable: false
          },
          {
            data: "attributes.hit",
            name: "hit",
            searchable: false,
          },
        ],
        order: [
          [1, 'desc']
        ]
      })

      arsip.on('draw.dt', function () {
        var PageInfo = $('#arsip-artikel').DataTable().page.info();
        arsip.column(0, {
          page: 'current'
        }).nodes().each(function (cell, i) {
          cell.innerHTML = i + 1 + PageInfo.start;
        });
      });
    });
  </script>
@endpush