@php $layout = 'full-content' @endphp
@extends('theme::layouts.master')

@section('content')
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i
      class="ti ti-shopping-bag"></i> Lapak {{ ucwords(setting('sebutan_desa')) }}</h1>

  <form method="get" class="w-full block py-2" id="form-cari">
    <div class="flex gap-3 lg:w-7/12 flex-col lg:flex-row">
      <select class="form-input inline-block select2" id="id_kategori" name="id_kategori" style="min-width: 25%">
        <option selected value="">Semua Kategori</option>
      </select>
      <input type="text" name="cari" id="search" maxlength="50" class="form-input" value="" placeholder="Cari Produk" style="min-width: 25%">
      <button type="submit" id="btn-cari" class="button button-primary flex-shrink-0 text-center" data-mdb-ripple="true" data-md-ripple-color="light">Cari</button>
      <button type="button" id="btn-semua" class="button button-tertiary flex-shrink-0 text-center" style="display: none;" data-mdb-ripple="true" data-md-ripple-color="light">Tampil Semua</button>
    </div>
  </form>

  <div id="loading">@include('theme::commons.loading')</div>
  <div class="grid grid-cols-1 lg:grid-cols-4 gap-5 py-5" id="produk-list"></div>

  @include('theme::commons.pagination')
  
  <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="map-modal" tabindex="-1" role="dialog" aria-labelledby="modalLokasi" aria-hidden="true">
    <div class="modal-dialog relative w-auto">
      <div class="modal-content rounded-lg">
        <div class="modal-header px-4 py-3 flex flex-row-reverse items-center justify-between text-left text-slate-800">
          <button type="button" class="btn-close box-content w-4 h-4 p-1 text-inherit border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:no-underline" data-bs-dismiss="modal" aria-label="Tutup"></button>
          <h4 class="modal-title font-bold text-left w-full dark:text-white">Lokasi Penjual</h4>
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
      const apiKategori = '{{ route("api.lapak.kategori") }}';
      $.get(apiKategori, function (data) {
        const kategori = data.data;
        const select = $("#id_kategori");
        kategori.forEach(function (item) {
          select.append(
            '<option value="' +
              item.id +
              '">' +
              item.attributes.kategori +
              "</option>"
          );
        });
      });

      function formatRupiah(angka, prefix = "Rp ") {
        let number_string = angka.toString().replace(/[^,\d]/g, ""),
          split = number_string.split(","),
          sisa = split[0].length % 3,
          rupiah = split[0].substr(0, sisa),
          ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
          separator = sisa ? "." : "";
          rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined
          ? rupiah
          : (rupiah ? "Rp " + rupiah : "") + ",00";
      }

      function loadProduk(params = {}) {
        const apiProduk = '{{ route("api.lapak.produk") }}';
        const produkList = $("#produk-list");

        $("#pagination-container").hide();
        produkList.empty();

        $.get(apiProduk, params, function (data) {
          const produk = data.data;

          produkList.empty();
          $("#loading").hide();

          if (!produk.length) {
            produkList.html('<p class="py-2 alert alert-info">Tidak ada produk yang tersedia</p>');
            return;
          }

          produk.forEach(function (item) {
            let fotoHTML = '<div class="owl-carousel one-carousel">';
            const fotoList = item.attributes.foto;

            fotoList.forEach(function (fotoItem) {
              fotoHTML += `<div class="item"><img src="${fotoItem}" alt="Foto Produk" class="h-44 w-full object-cover object-center bg-gray-300"></div>`;
            });

            fotoHTML += "</div>";

            const hargaDiskon = formatRupiah(item.attributes.harga_diskon, "Rp ");
            const hargaAwal = formatRupiah(item.attributes.harga, "Rp ");
            const viewDiskon =
              hargaAwal === hargaDiskon
                ? ``
                : `<span class="text-xs text-red-500">${hargaAwal}</span>`;

            const produkHTML = `
                      <div class="card p-4 flex flex-col justify-between space-y-4 border border-slate-300 dark:border-slate-300 this-product">
                        <div class="space-y-3">
                          ${fotoHTML}
                          <div class="space-y-1/2 text-sm flex flex-col detail">
                            <span class="font-heading font-medium">${
                              item.attributes.nama
                            }</span>
                            ${viewDiskon}
                            <span class="text-lg font-bold">${hargaDiskon} <span class="text-xs font-thin">/ ${item.attributes.satuan}</span></span>
                            <p class="text-xs pt-1">${
                              item.attributes.deskripsi
                            }</p>
                            <span class="pt-2 text-xs font-bold text-gray-500 dark:text-gray-50">
                                <i class="ti ti-award mr-1"></i> ${item.attributes.pelapak.penduduk.nama ?? "Admin" } <i class="ti ti-check text-xs bg-emerald-500 h-4 w-4 inline-flex items-center justify-center rounded-full text-white"></i>
                            </span>
                          </div>
                        </div>
                        <div class="group flex items-center space-x-1">
                          <a href="${item.attributes.pesan_wa}" 
                              rel="noopener noreferrer" target="_blank" class="button button-primary text-xs text-center">
                              <i class="ti ti-shopping-cart mr-1"></i> Beli Sekarang
                          </a>
                          <button type="button" class="button button-secondary text-xs text-center rounded-0" data-mdb-ripple="true" data-md-ripple-color="light" data-bs-toggle="modal" data-bs-target="#map-modal" data-bs-remote="false" title="Lokasi" data-lat="${item.attributes.pelapak.lat}"
                              data-lng="${item.attributes.pelapak.lng}" data-zoom="${item.attributes.pelapak.zoom}" data-title="Lokasi ${item.attributes.pelapak.penduduk.nama}"><i class="ti ti-map-pin mr-1"></i> Lokasi</button>
                        </div>
                    </div>
                `;

            produkList.append(produkHTML);
          });

          initPagination(data);

          $(".owl-carousel").owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 3000,
          });
        });
      }

      $("#form-cari").on("submit", function (e) {
        e.preventDefault();
        var params = {};
        var kategori = $("#id_kategori").val();
        var search = $("#search").val();

        if (kategori) {
          params["filter[id_produk_kategori]"] = kategori;
        }

        if (search) {
          params["filter[search]"] = search;
        }

        $("#loading").show();

        loadProduk(params);

        $("#btn-semua").show();
      });

      $("#pagination-container").on("click", ".pagination-link", function () {
        var params = {};
        var page = $(this).data("page");
        var kategori = $("#id_kategori").val();
        var search = $("#search").val();

        if (kategori) {
          params["filter[id_produk_kategori]"] = kategori;
        }

        if (search) {
          params["filter[search]"] = search;
        }

        params["page[number]"] = page;

        loadProduk(params);
      });

      $("#btn-semua").on("click", function () {
        $("#loading").show();
        loadProduk();
        $("#btn-semua").hide();
        $("#search").val("");
        $("#id_kategori").val("");
      });

      loadProduk();

      $(document).on("shown.bs.modal", "#map-modal", function (event) {
        const link = $(event.relatedTarget);
        const modal = $(this);
        modal.find(".modal-body").html("<div id='map' style='width: 100%; height:450px !important'></div>");
        const popup = `
        <div class="group">
          <div class="space-y-2 text-xs">
            <img loading="lazy" src=${link
              .closest(".this-product")
              .find("img:nth-child(1)")
              .attr(
                "src"
              )} alt="produk" class="h-44 w-full object-cover object-center bg-slate-300 dark:bg-slate-600" style="min-width: 14rem;">
            <div class="pt-2 space-y-1/2 text-sm flex flex-col">
              ${link.closest(".this-product").find(".detail").html()}
            </div>
          </div>
        </div>`;

        const posisi = [link.data("lat"), link.data("lng")];
        const zoom = link.data("zoom") || 10;
        const popupContent = link.closest(".this-product").find(".detail").html();

        const mapOptions = {
          maxZoom: setting.max_zoom_peta,
          minZoom: setting.min_zoom_peta,
        };

        $("#lat").val(posisi[0]);
        $("#lng").val(posisi[1]);

        if (window.pelapak) {
          window.pelapak.remove();
        }

        window.pelapak = L.map("map", mapOptions).setView(posisi, zoom);
        getBaseLayers(window.pelapak, setting.mapbox_key, setting.jenis_peta);

        const markerIcon = L.icon({
          iconUrl: setting.icon_lapak_peta,
        });

        L.marker(posisi, {
          icon: markerIcon,
        }).addTo(window.pelapak).bindPopup(popup);

        L.control.scale().addTo(window.pelapak);

        window.pelapak.invalidateSize();
      });
    });

  </script>
@endpush