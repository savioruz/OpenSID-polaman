@php $layout = 'full-content' @endphp
@extends('theme::layouts.master')

@section('content')
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i class="ti ti-map"></i> Peta {{ ucwords(setting('sebutan_desa')) }}
    {{ ucwords(identitas('nama_desa')) }}</h1>
  <div class="space-y-2 pt-5" id="main-peta">
    <div class="col-md-12">
      <div id="loading">@include('theme::commons.loading')</div>
      <div id="map">
        <div class="leaflet-top leaflet-left">
          <div id="isi_popup" style="visibility: hidden;">
            <div id="content">
              <h5 id="firstHeading" class="firstHeading"></h5>
              <div id="bodyContent">

              </div>
            </div>
          </div>
          <div id="isi_popup_dusun"></div>
          <div id="isi_popup_rw"></div>
          <div id="isi_popup_rt"></div>
        </div>
        <div class="leaflet-bottom leaflet-left">
          <div id="qrcode" class="hidden">
            <div class="panel-body-lg">
              <a href="https://github.com/OpenSID/OpenSID">
                <img src="{{ to_base64(GAMBAR_QRCODE) }}" alt="OpenSID">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section class="h-0">
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="modal-content" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
      data-backdrop="false">
      <div class="modal-dialog modal-dialog relative w-auto">
        <div class="modal-content rounded-lg">
          <div class="modal-header px-4 py-3 flex flex-row-reverse items-center justify-between text-left text-slate-800">
            <button type="button" class="border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:no-underline" data-bs-dismiss="modal" aria-label="Tutup"><i class="ti ti-x text-xl dark:text-white"></i></button>
            <h4 class="modal-title font-bold text-left w-full dark:text-white" id="myModalLabel"></h4>
          </div>
          <div class="fetched-data"></div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/leaflet-measure-path.css') }}">
  <link rel="stylesheet" href="{{ asset('css/MarkerCluster.css') }}">
  <link rel="stylesheet" href="{{ asset('css/MarkerCluster.Default.css') }}">
  <link rel="stylesheet" href="{{ asset('css/leaflet.groupedlayercontrol.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/leaflet.fullscreen.css') }}" />
  <style>
    #map {
      width: 100%;
      height: 88vh !important;
    }

    #map .leaflet-popup-content {
      height: auto;
      overflow-y: auto;
    }

    table {
      table-layout: fixed;
      white-space: normal !important;
    }

    td {
      word-wrap: break-word;
    }

    .persil {
      min-width: 350px;
    }

    .persil td {
      padding-right: 1rem;
    }

    .btn.btn-social {
      color: #fff !important;
    }
    .table-responsive overflow-auto w-full {
      overflow-x: auto;
    }
    .table-responsive overflow-auto w-full tbody {
      font-size: .85rem;
    }
    .statistik-link {
      color: var(--primary-color) !important;
    }
    .modal-body .col-md-12 > * + * {
      margin-top: 1.5rem !important;
    }

    .modal-body center, .modal-body hr {
      display: block;
    }

    .modal-body .box-title {
      font-size: 1.15rem;
    }
    .modal-body .btn {
      padding: 8px 14px;
      border-radius: 5px;
      cursor: pointer;
    }
    .modal-body .btn:first-child {
      background: var(--secondary-color) !important;
    }
    .modal-body .btn:last-child {
      background: var(--accent-color) !important;
    }
    .dark a[data-bs-toggle="modal"] {
      color: #efefef !important;
    }

    .dark #transparansi-footer {
      background: transparent !important;
      color: #fff !important;
    }

    .leaflet-popup-content {
      overflow-y: auto !important;
    }

    #transparansi-footer div[align="center"] {
      height: auto !important;
    }

    #transparansi-footer hr + .progress-group {
      margin-top: 8px;
    }

    #transparansi-footer .progress {
    position: relative !important;
    margin-top: 0.5rem !important;
    margin-bottom: 0.5rem !important;
    height: 1.25rem !important;
    width: 100% !important;
    overflow: hidden !important;
    border-radius: 0.375rem !important;
    background-color: var(--primary-color) !important;
    text-align: left !important;
    --tw-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1) !important;
    --tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color) !important;
    box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow) !important;
    }
    #transparansi-footer .progress-bar {
      display: flex !important;
      height: 100% !important;
      align-items: center !important;
      background-color: var(--secondary-color) !important;
      width: 0px;
    }
    #transparansi-footer .progress-bar span {
      position: absolute !important;
      right: 0px !important;
      display: block !important;
      transform: var(--tw-transform) !important;
      padding-right: 0.75rem !important;
      text-align: right !important;
      font-size: 0.875rem !important;
      line-height: 1.25rem !important;
      --tw-text-opacity: 1 !important;
      color: rgb(255 255 255 / var(--tw-text-opacity)) !important;
    }
  </style>
  <script>
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
  </script>
@endpush

@push('scripts')
  <script src="{{ theme_asset('lib/js/helper.js') }}"></script>
  <script>
    $(document).ready(function () {
      const _url = `{{ ci_route('internal_api.peta') }}`
      // remove header dan footer
      $('#main-peta').siblings('.container').remove()
      $.get(_url, {}, function (json) {
        $('#loading').empty();
        $('#qrcode').removeClass('hidden');

        generatePopupDesa(json.data[0].attributes)
        generatePopupDusun(json.data[0].attributes)
        generatePopupRw(json.data[0].attributes)
        generatePopupRt(json.data[0].attributes)
        generatePeta(json.data[0].attributes)

        $('#isi_popup_dusun').remove();
        $('#isi_popup_rw').remove();
        $('#isi_popup_rt').remove();
        $('#isi_popup').remove();
        $('.spinner-grow').parent().remove()
      })

      const generatePopupDesa = function (data) {
        let _listLink = [],
          _elmPopup
        const _link = '{{ ci_route("statistik_web.chart_gis_desa") }}'
        _elmPopup = document.getElementById('isi_popup')
        _elmPopup.querySelector('#content').querySelector('#firstHeading').innerHTML = `Wilayah {{ ucwords(setting('sebutan_desa')) }} ${data.desa.nama_desa}`
        const _title = `{{ ucwords(setting('sebutan_desa')) }} ${capitalizeFirstCharacterOfEachWord(data.desa.nama_desa)}`
        // statistik penduduk
        if (data.pengaturan.includes('Statistik Penduduk')) {
          _listLink = []
          for (let key in data.list_ref) {
            _listLink.push(`<li><a class="py-0.5 statistik-link font-body text-sm dark:text-white block" href="${_link}/${key}/${data.desa.nama_desa.replace(/\s+/g, '_')}" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#modal-content" data-title="Statistik Penduduk ${_title} (${data.list_ref[key]})" >${data.list_ref[key]}</a></li>`)
          }
          const _listStatistikPenduduk = `<p><button href="#collapseStatPenduduk" class="button button-primary w-full font-body text-sm block my-2 text-center !text-white" title="Statistik Penduduk" data-bs-toggle="collapse" data-bs-target="#collapseStatPenduduk" aria-expanded="false" aria-controls="collapseStatPenduduk"><i class="ti ti-users"></i>&nbsp;&nbsp;Statistik Penduduk&nbsp;&nbsp;</button></p>
            <div class="collapse box-body no-padding" id="collapseStatPenduduk">
              <div class="group">
                <ul>
                ${_listLink.join('')}
                </ul>
              </div>
            </div>`
          _elmPopup.querySelector('#content').querySelector('#bodyContent').innerHTML += _listStatistikPenduduk
        }
        // statistik bantuan
        if (data.pengaturan.includes('Statistik Bantuan')) {
          _listLink = []
          for (let key in data.list_bantuan) {
            _listLink.push(`<li><a class="py-0.5 statistik-link font-body text-sm dark:text-white block" href="${_link}/${key}/${data.desa.nama_desa.replace(/\s+/g, '_')}" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#modal-content" data-title="Statistik Bantuan ${_title} (${data.list_bantuan[key]})">${data.list_bantuan[key]}</a></li>`)
          }
          const _listStatistikBantuan = `<p><button href="#collapseStatBantuan" class="button button-primary w-full font-body text-sm block my-2 text-center !text-white" title="Statistik Bantuan" data-bs-toggle="collapse" data-bs-target="#collapseStatBantuan" aria-expanded="false" aria-controls="collapseStatBantuan"><i class="ti ti-heart"></i>&nbsp;&nbsp;Statistik Bantuan&nbsp;&nbsp;</button></p>
            <div class="collapse box-body no-padding" id="collapseStatBantuan">
              <div class="group">
                <ul>
                ${_listLink.join('')}
                </ul>
              </div>
            </div>`
          _elmPopup.querySelector('#content').querySelector('#bodyContent').innerHTML += _listStatistikBantuan
        }
        // statistik aparatur
        if (data.pengaturan.includes('Aparatur Desa')) {
          _elmPopup.querySelector('#content').querySelector('#bodyContent').innerHTML += `<p><a href="{{ ci_route('load_aparatur_desa') }}" class="button button-primary w-full font-body text-sm block my-2 text-center !text-white" data-title="{{ ucwords(setting('sebutan_pemerintah_desa')) }}" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#modal-content"><i class="ti ti-user"></i>&nbsp;&nbsp;{{ ucwords(setting('sebutan_pemerintah_desa')) }}&nbsp;&nbsp;</a></p>`
        }
      }
      const generatePopupDusun = function (data) {
        const _elmPopup = document.getElementById('isi_popup_dusun')
        const _link = '{{ ci_route("statistik_web.chart_gis_dusun") }}'
        const _title = `{{ ucwords(setting('sebutan_desa')) }} ${capitalizeFirstCharacterOfEachWord(data.desa.nama_desa)}`
        const _wilayah = {
          level: 1,
          key: 'dusun',
          sebutan: "{{ ucwords(setting('sebutan_kepala_dusun')) }}",
          div_parent: 'isi_popup_dusun'
        }
        _elmPopup.innerHTML = generatePopupElement(data, data.pengaturan, data.dusun_gis, _link, _title, _wilayah)
      }
      const generatePopupRw = function (data) {
        const _elmPopup = document.getElementById('isi_popup_rw')
        const _link = '{{ ci_route("statistik_web.chart_gis_rw") }}'
        const _title = `{{ ucwords(setting('sebutan_dusun')) }}`
        const _wilayah = {
          level: 2,
          key: 'rw',
          sebutan: "RW",
          div_parent: 'isi_popup_rw'
        }
        _elmPopup.innerHTML = generatePopupElement(data, data.pengaturan, data.rw_gis, _link, _title, _wilayah)
      }
      const generatePopupRt = function (data) {
        const _elmPopup = document.getElementById('isi_popup_rt')
        const _link = '{{ ci_route("statistik_web.chart_gis_rt") }}'
        const _title = `{{ ucwords(setting('sebutan_dusun')) }}`
        const _wilayah = {
          level: 3,
          key: 'rt',
          sebutan: "RT",
          div_parent: 'isi_popup_rt'
        }
        _elmPopup.innerHTML = generatePopupElement(data, data.pengaturan, data.rt_gis, _link, _title, _wilayah)
      }
      const generatePopupElement = function (data, pengaturan, gis, _link, _title, _wilayah) {
        let _listLink = [],
          _params, _newTitle
        let _parentElementHTML = ``,
          _elemenHTML, _contentHTML = ``,
          _listStatistikPenduduk, _listStatistikBantuan

        for (let _key in gis) {
          _elemenHTML = ``
          _contentHTML = ``
          switch (_wilayah['key']) {
            case 'dusun':
              _params = underscore(gis[_key]['dusun'])
              _newTitle = `${_title} ${capitalizeFirstCharacterOfEachWord(gis[_key]['dusun'])}`
              break;
            case 'rw':
              _params = `${underscore(gis[_key]['dusun'])}/${underscore(gis[_key]['rw'])}`
              _newTitle = `RW ${capitalizeFirstCharacterOfEachWord(gis[_key]['rw'])} ${_title} ${capitalizeFirstCharacterOfEachWord(gis[_key]['dusun'])}`
              break;
            case 'rt':
              _params = `${underscore(gis[_key]['dusun'])}/${underscore(gis[_key]['rw'])}/${underscore(gis[_key]['rt'])}`
              _newTitle = `RT ${capitalizeFirstCharacterOfEachWord(gis[_key]['rt'])} RW ${capitalizeFirstCharacterOfEachWord(gis[_key]['rw'])} ${_title} ${capitalizeFirstCharacterOfEachWord(gis[_key]['dusun'])}`
              break;
          }

          // statistik penduduk
          if (pengaturan.includes('Statistik Penduduk')) {
            _listLink = []
            for (let key in data.list_ref) {
              _listLink.push(`<li><a class="py-0.5 statistik-link font-primary dark:text-white block" href="${_link}/${key}/${_params}" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#modal-content" data-title="Statistik Penduduk ${_newTitle} (${data.list_ref[key]})" >${data.list_ref[key]}</a></li>`)
            }
            _listStatistikPenduduk = `<p><button class="button button-primary w-full font-body text-sm block my-2 text-center !text-white" title="Statistik Penduduk" data-bs-toggle="collapse" data-bs-target="#collapseStatPenduduk" aria-expanded="false" aria-controls="collapseStatPenduduk"><i class="ti ti-users"></i>&nbsp;&nbsp;Statistik Penduduk&nbsp;&nbsp;</button></p>
              <div class="collapse box-body no-padding" id="collapseStatPenduduk">
                <div class="group">
                  <ul>
                  ${_listLink.join('')}
                  </ul>
                </div>
              </div>`
            _contentHTML += _listStatistikPenduduk
          }
          // statistik bantuan
          if (pengaturan.includes('Statistik Bantuan')) {
            _listLink = []
            for (let key in data.list_bantuan) {
              _listLink.push(`<li><a class="py-0.5 statistik-link font-primary dark:text-white block" href="${_link}/${key}/${_params}" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#modal-content" data-title="Statistik Bantuan ${_newTitle} (${data.list_bantuan[key]})">${data.list_bantuan[key]}</a></li>`)
            }
            _listStatistikBantuan = `<p><button class="button button-primary w-full font-body text-sm block my-2 text-center !text-white" title="Statistik Bantuan" data-bs-toggle="collapse" data-bs-target="#collapseStatBantuan" aria-expanded="false" aria-controls="collapseStatBantuan"><i class="ti ti-heart"></i>&nbsp;&nbsp;Statistik Bantuan&nbsp;&nbsp;</button></p>
              <div class="collapse box-body no-padding" id="collapseStatBantuan">
                <div class="group">
                  <ul>
                  ${_listLink.join('')}
                  </ul>
                </div>
              </div>`
            _contentHTML += _listStatistikBantuan
          }
          // statistik aparatur
          if (pengaturan.includes('Aparatur Desa')) {
            _contentHTML += `<p><a href="{{ ci_route("load_aparatur_wilayah") }}/${gis[_key]['id_kepala']}/${_wilayah['level']}" class="button button-primary w-full font-body text-sm block my-2 text-center !text-white" data-title="{{ ucwords(setting('sebutan_kepala_dusun')) . ' ' . $dusun['dusun'] }}" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#modal-content"><i class="ti ti-user"></i>&nbsp;&nbsp;${_wilayah['sebutan']}&nbsp;&nbsp;</a></p>`
          }
          _elemenHTML = `
            <div id="${_wilayah['div_parent']}_${_key}" style="visibility: hidden;">
              <div id="content">
                <h5 id="firstHeading" class="firstHeading">Wilayah ${_newTitle}</h5>
                  <div id="bodyContent">
                    ${_contentHTML}
                  </div>
              </div>
            </div>`

          _parentElementHTML += _elemenHTML
        }
        return _parentElementHTML
      }
      
      const generatePeta = function (data) {
        let posisi = [-1.0546279422758742, 116.71875000000001];
        let zoom = 10;
        let wilayah_desa;
        let options = {
          maxZoom: {{ setting('max_zoom_peta') }},
          minZoom: {{ setting('min_zoom_peta') }},
          fullscreenControl: {
            position: 'topright' // Menentukan posisi tombol fullscreen
          }
        }
        if (data.desa['lat'] && data.desa['lng']) {
          posisi = [data.desa['lat'], data.desa['lng']]
          zoom = data.desa['zoom'] ?? 10
        } else if (data.desa['path']) {
          wilayah_desa = data.desa['path'];
          posisi = wilayah_desa[0][0];
          zoom = data.desa['zoom'] ?? 10
        }
        //Inisialisasi tampilan peta
        const mymap = L.map('map', options).setView(posisi, zoom);
        if (data.desa['path']) {
          mymap.fitBounds(JSON.parse(data.desa.path));
        }

        //Menampilkan overlayLayers Peta Semua Wilayah
        let marker_desa = [];
        let marker_dusun = [];
        let marker_rw = [];
        let marker_rt = [];
        let marker_area = [];
        let marker_garis = [];
        let marker_lokasi = [];
        let markers = new L.MarkerClusterGroup();
        let markersList = [];
        let marker_legend = [];
        let mark_desa = [];
        let mark_covid = [];

        // deklrasi variabel agar mudah di baca
        let all_area = JSON.stringify(data.area)
        let all_garis = JSON.stringify(data.garis)
        let all_lokasi = JSON.stringify(data.lokasi)
        let all_lokasi_pembangunan = JSON.stringify(data.lokasi_pembangunan)
        let LOKASI_SIMBOL_LOKASI = '{{ base_url(LOKASI_SIMBOL_LOKASI) }}';
        let favico_desa = '{{ favico_desa() }}';
        let LOKASI_FOTO_AREA = '{{ base_url(LOKASI_FOTO_AREA) }}';
        let LOKASI_FOTO_GARIS = '{{ base_url(LOKASI_FOTO_GARIS) }}';
        let LOKASI_FOTO_LOKASI = '{{ base_url(LOKASI_FOTO_LOKASI) }}';
        let LOKASI_GALERI = '{{ base_url(LOKASI_GALERI) }}';
        let info_pembangunan = '{{ ci_route('pembangunan') }}';
        let all_persil = JSON.stringify(data.persil)
        let TAMPIL_LUAS = '{{ setting('tampil_luas_peta') }}';
        let PENGATURAN_WILAYAH = '{!! SebutanDesa(setting('default_tampil_peta_wilayah')) ?: [] !!}';
        let PENGATURAN_INFRASTRUKTUR = '{!! SebutanDesa(setting('default_tampil_peta_infrastruktur')) ?: [] !!}';
        let WILAYAH_INFRASTRUKTUR = PENGATURAN_WILAYAH.concat(PENGATURAN_INFRASTRUKTUR);

        //OVERLAY WILAYAH DESA
        if (data.desa['path']) {
          set_marker_desa_content(marker_desa, data.desa, "{{ ucwords(setting('sebutan_desa')) }} ${data.desa['nama_desa']}", "{{ favico_desa() }}", '#isi_popup');
        }

        //OVERLAY WILAYAH DUSUN
        if (data.dusun_gis) {
          set_marker_multi_content(marker_dusun, JSON.stringify(data.dusun_gis), '{{ ucwords(setting('sebutan_dusun')) }}', 'dusun', '#isi_popup_dusun_', '{{ favico_desa() }}');
        }

        //OVERLAY WILAYAH RW
        if (data.rw_gis) {
          set_marker_content(marker_rw, JSON.stringify(data.rw_gis), 'RW', 'rw', '#isi_popup_rw_', '{{ favico_desa() }}');
        }

        //OVERLAY WILAYAH RT
        if (data.rt_gis) {
          set_marker_content(marker_rt, JSON.stringify(data.rt_gis), 'RT', 'rt', '#isi_popup_rt_', '{{ favico_desa() }}');
        }

        //Menampilkan overlayLayers Peta Semua Wilayah
        let overlayLayers = overlayWil(
          marker_desa,
          marker_dusun,
          marker_rw,
          marker_rt,
          "{{ ucwords(setting('sebutan_desa')) }}",
          "{{ ucwords(setting('sebutan_dusun')) }}",
          true,
          TAMPIL_LUAS.toString()
        );

        //Menampilkan BaseLayers Peta
        let baseLayers = getBaseLayers(mymap, "{{ setting('mapbox_key') }}", "{{ setting('jenis_peta') }}");

        //Geolocation IP Route/GPS
        geoLocation(mymap);

        //Menambahkan zoom scale ke peta
        L.control.scale().addTo(mymap);

        //Mencetak peta ke PNG
        cetakPeta(mymap);

        //Menambahkan Legenda Ke Peta
        let legenda_desa = L.control({
          position: 'bottomright'
        });
        let legenda_dusun = L.control({
          position: 'bottomright'
        });
        let legenda_rw = L.control({
          position: 'bottomright'
        });
        let legenda_rt = L.control({
          position: 'bottomright'
        });

        mymap.on('overlayadd', function (eventLayer) {
          if (eventLayer.name === 'Peta Wilayah Desa') {
            setlegendPetaDesa(legenda_desa, mymap, data.desa, '{{ ucwords(setting('sebutan_desa')) }}', data.desa['nama_desa']);
          }
          if (eventLayer.name === 'Peta Wilayah Dusun') {
            setlegendPeta(legenda_dusun, mymap, JSON.stringify(data.dusun_gis), '{{ ucwords(setting('sebutan_dusun')) }}', 'dusun', '', '');
          }
          if (eventLayer.name === 'Peta Wilayah RW') {
            setlegendPeta(legenda_rw, mymap, JSON.stringify(data.rw_gis), 'RW', 'rw', '{{ ucwords(setting('sebutan_dusun')) }}');
          }
          if (eventLayer.name === 'Peta Wilayah RT') {
            setlegendPeta(legenda_rt, mymap, JSON.stringify(data.rt_gis), 'RT', 'rt', 'RW');
          }
        });

        mymap.on('overlayremove', function (eventLayer) {
          if (eventLayer.name === 'Peta Wilayah Desa') {
            mymap.removeControl(legenda_desa);
          }
          if (eventLayer.name === 'Peta Wilayah Dusun') {
            mymap.removeControl(legenda_dusun);
          }
          if (eventLayer.name === 'Peta Wilayah RW') {
            mymap.removeControl(legenda_rw);
          }
          if (eventLayer.name === 'Peta Wilayah RT') {
            mymap.removeControl(legenda_rt);
          }
        });

        // Menampilkan OverLayer Area, Garis, Lokasi plus Lokasi Pembangunan
        let layerCustom = tampilkan_layer_area_garis_lokasi_plus(
          mymap,
          all_area,
          all_garis,
          all_lokasi,
          all_lokasi_pembangunan,
          LOKASI_SIMBOL_LOKASI,
          favico_desa,
          LOKASI_FOTO_AREA,
          LOKASI_FOTO_GARIS,
          LOKASI_FOTO_LOKASI,
          LOKASI_GALERI,
          info_pembangunan,
          all_persil,
          TAMPIL_LUAS.toString()
        );

        L.control.layers(baseLayers, overlayLayers, {
          position: 'topleft',
          collapsed: true
        }).addTo(mymap);
        L.control.groupedLayers('', layerCustom, {
          groupCheckboxes: true,
          position: 'topleft',
          collapsed: true
        }).addTo(mymap);
        let labelCheckbox
        $('input[type=checkbox]:not(.toggle-check)').each(function () {
          labelCheckbox = $(this).next().text().trim()
          if (WILAYAH_INFRASTRUKTUR.includes(labelCheckbox)) {
            $(this).click();
          }
          if (labelCheckbox == 'Letter C-Desa') {
            if (data.tampilkan_cdesa != 1) {
              $(this).parent().remove()
            }
          }
        });

        $('.fa.fa-map-marker').addClass('ti ti-map-pin text-lg');

        $('body').on('click', 'a[data-bs-target="#modal-content"]', function(e) {
          e.preventDefault(); // Prevent default link behavior

          const title = $(this).data('title');
          const href = $(this).attr('href');

          // Set the modal title and load the content
          $('#modal-content .modal-title').text(title);
          $('#modal-content .fetched-data').html(`<div class="py-2">@include('theme::commons.loading')</div>`);
          $('#modal-content .fetched-data').load(href, function() {
            if (href != '{{ ci_route('load_aparatur_desa') }}') {
              $(this).find('link[rel="stylesheet"]').remove();
              $(this).find('script').remove();
              $(this).find('style').remove();
              $(this).addClass('p-5')
            }
          });

          // Show the modal
          $('#modal-content').modal('show');
        });
      }
    })
  </script>
  <script src="{{ asset('js/Leaflet.fullscreen.min.js') }}"></script>
  <script src="{{ asset('js/turf.min.js') }}"></script>
  <script src="{{ asset('js/leaflet-providers.js') }}"></script>
  <script src="{{ asset('js/L.Control.Locate.min.js') }}"></script>
  <script src="{{ asset('js/leaflet-measure-path.js') }}"></script>
  <script src="{{ asset('js/leaflet.markercluster.js') }}"></script>
  <script src="{{ asset('js/leaflet.groupedlayercontrol.min.js') }}"></script>
  <script src="{{ asset('js/leaflet.browser.print.js') }}"></script>
  <script src="{{ asset('js/leaflet.browser.print.utils.js') }}"></script>
  <script src="{{ asset('js/leaflet.browser.print.sizes.js') }}"></script>
  <script src="{{ asset('js/dom-to-image.min.js') }}"></script>
@endpush