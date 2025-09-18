@php $layout = 'full-content' @endphp
@extends('theme::layouts.master')

@section('content')
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i
      class="ti ti-backhoe"></i> Pembangunan</h1>

  <div id="loading">@include('theme::commons.loading')</div>
  <div class="grid grid-cols-1 lg:grid-cols-4 gap-5 py-5" id="pembangunan-list"></div>

  @include('theme::commons.pagination')
  
  <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="map-modal" tabindex="-1" role="dialog" aria-labelledby="modalLokasi" aria-hidden="true">
    <div class="modal-dialog relative w-auto">
      <div class="modal-content rounded-lg">
        <div class="modal-header px-4 py-3 flex flex-row-reverse items-center justify-between text-left text-slate-800">
          <button type="button" class="btn-close box-content w-4 h-4 p-1 text-inherit border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:no-underline" data-bs-dismiss="modal" aria-label="Tutup"></button>
          <h4 class="modal-title font-bold text-left w-full dark:text-white"></h4>
        </div>
        <div class="modal-body relative">
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      function loadPembangunan(params = {}) {

        var apiPembangunan = '{{ route("api.pembangunan") }}';

        $('#pagination-container').hide();

        $.get(apiPembangunan, params, function (data) {
          var pembangunan = data.data;
          var pembangunanList = $('#pembangunan-list');

          pembangunanList.empty();
          $('#loading').empty();

          if (!pembangunan.length) {
            pembangunanList.html('<p class="py-2">Tidak ada pembangunan yang tersedia</p>');
            return;
          }

          pembangunan.forEach(function (item) {
            var url = SITE_URL + 'pembangunan/' + item.attributes.slug;
            var fotoHTML = `<img class="h-44 w-full object-cover object-center bg-slate-300 dark:bg-slate-600"
                        src="${item.attributes.foto}" alt="Foto Pembangunan" />`

            var buttonMap = '';
            if (item.attributes.lat && item.attributes.lng) {
              buttonMap = `<button type="button" class="button button-secondary text-xs text-center rounded-0" data-mdb-ripple="true" data-md-ripple-color="light" data-bs-toggle="modal" data-bs-target="#map-modal" data-bs-remote="false" title="Lokasi" data-lat="${item.attributes.lat}"
                        data-lng="${item.attributes.lng}" data-title="Lokasi Pembangunan"><i class="ti ti-map-pin mr-2"></i>
                        Lokasi</button>`;
            }

            var pembangunanHTML = `
                    <div class="card p-4 flex flex-col justify-between space-y-4 border border-slate-300 dark:border-slate-300 this-construction">
                        <div class="space-y-3">
                            ${fotoHTML}
                            <div class="space-y-2 text-sm flex flex-col detail">
                                <h3 class="font-heading font-bold text-base">${item.attributes.judul}</h3>
                                <div class="inline-flex"><i class="ti ti-calendar mr-2"></i>
                                    ${item.attributes.tahun_anggaran}
                                </div>
                                <div class="inline-flex">
                                    <i class="ti ti-map-pin mr-1"></i>
                                    ${item.attributes.lokasi}
                                </div>
                                <p class="text-sm pt-1">
                                    ${item.attributes.keterangan.length > 100 ? item.attributes.keterangan.substring(0, 100) + '...' : item.attributes.keterangan}
                                </p>
                            </div>
                        </div>
                        <div class="group flex items-center space-x-1">
                            <a href="${url}"
                                class="button button-primary text-xs text-center rounded-0">Selengkapnya <i class="ti ti-chevron-right ml-1"></i>
                            </a>
                            ${buttonMap}
                        </div>
                    </div>
                `;

            pembangunanList.append(pembangunanHTML);
          });

          initPagination(data);
        });
      }
      $('#pagination-container').on('click', '.pagination-link', function () {
        var params = {};
        var page = $(this).data("page");

        params["page[number]"] = page;

        loadPembangunan(params);
      });

      loadPembangunan();
      $(document).on("shown.bs.modal", "#map-modal", function (event) {
        const link = $(event.relatedTarget);
        const title = link.data("title");
        const modal = $(this);
        modal.find(".modal-title").text(title);
        modal.find(".modal-body").html("<div id='map' style='width: 100%; height:450px !important'></div>");

        const popup = `
              <div class="group">
                <div class="space-y-2 text-xs">
                  <img loading="lazy" src=${link
                    .closest(".this-construction")
                    .find("img:nth-child(1)")
                    .attr(
                      "src"
                    )} alt="pembangunan" class="h-44 w-full object-cover object-center bg-slate-300 dark:bg-slate-600" style="min-width: 14rem;">
                  <div class="pt-2 space-y-1/2 text-sm flex flex-col">
                    ${link.closest(".this-construction").find(".detail").html()}
                  </div>
                </div>
              </div>`;

        const posisi = [link.data('lat'), link.data('lng')];
        const zoom = link.data('zoom') || 10;
        const mapOptions = {
          maxZoom: setting.max_zoom_peta,
          minZoom: setting.min_zoom_peta
        };

        $('#lat').val(posisi[0]);
        $('#lng').val(posisi[1]);

        // Inisialisasi tampilan peta
        pembangunan = L.map("map").setView(posisi, zoom);

        // Menampilkan BaseLayers Peta
        getBaseLayers(pembangunan, setting.mapbox_key, setting.jenis_peta);

        // Tampilkan Posisi pembangunan
        marker = new L.Marker(posisi, {
          draggable: false,
        });

        const markerIcon = L.icon({
          iconUrl: setting.icon_pembangunan_peta
        });
        pembangunan.addLayer(marker);
        L.marker(posisi).addTo(pembangunan).bindPopup(popup).openPopup();
        L.control.scale().addTo(pembangunan);
      });
    });
  </script>
@endpush