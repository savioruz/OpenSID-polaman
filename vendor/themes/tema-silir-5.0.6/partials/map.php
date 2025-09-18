<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<form id="mainform_map" name="mainform_map" method="post">
  <div class="row">
    <div class="col-md-12">
      <div id="map">
        <?php $this->load->view("gis/cetak_peta") ?>
        <div class="leaflet-top leaflet-left">
          <?php $this->load->view($folder_themes . "/partials/gis/content_desa_web.php", ["desa" => $desa, "list_ref" => $list_ref, "wilayah" => ucwords($this->setting->sebutan_desa . " " . $desa["nama_desa"])]) ?>
          <?php $this->load->view($folder_themes . "/partials/gis/content_dusun_web.php", ["dusun_gis" => $dusun_gis, "list_ref" => $list_ref, "wilayah" => ucwords($this->setting->sebutan_dusun . " ")]) ?>
          <?php $this->load->view($folder_themes . "/partials/gis/content_rw_web.php", ["rw_gis" => $rw_gis, "list_ref" => $list_ref, "wilayah" => ucwords($this->setting->sebutan_dusun . " ")]) ?>
          <?php $this->load->view($folder_themes . "/partials/gis/content_rt_web.php", ["rt_gis" => $rt_gis, "list_ref" => $list_ref, "wilayah" => ucwords($this->setting->sebutan_dusun . " ")]) ?>
        </div>
        <div id="desa_online" class="hidden">
          <div class="leaflet-top leaflet-right">
            <section class="content">
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="ti ti-map-pin">
                    <H5 class="info legend">NEGARA</H5>
                  </i></span>
                <div class="info-box-content">
                  <span class="info-box-text nama_negara"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="info-box-number jml_desa"></span>
                  <span class="progress-description"><i>Desa OpenSID Aktif</i></span>
                </div>
              </div>
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="ti ti-map-pin">
                    <h5 class="info legend">PROV.</h5>
                  </i></span>
                <div class="info-box-content">
                  <span class="info-box-text nama_prov"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="info-box-number jml_desa_prov"></span>
                  <span class="progress-description"><i>Desa OpenSID Aktif</i></span>
                </div>
              </div>
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="ti ti-map-pin">
                    <h5 class="info legend">KAB.</h5>
                  </i></span>
                <div class="info-box-content">
                  <span class="info-box-text nama_kab"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="info-box-number jml_desa_kab"></span>
                  <span class="progress-description"><i>Desa OpenSID Aktif</i></span>
                </div>
              </div>
              <div class="info-box bg-blue">
                <span class="info-box-icon"><i class="ti ti-map-pin">
                    <h5 class="info legend">KEC.</h5>
                  </i></span>
                <div class="info-box-content">
                  <span class="info-box-text nama_kec"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="info-box-number jml_desa_kec"></span>
                  <span class="progress-description"><i>Desa OpenSID Aktif</i></span>
                </div>
              </div>
            </section>
          </div>
        </div>
        <div class="leaflet-top leaflet-right">
          <div id="covid_status_local" style="display: none;">
            <?php if ($this->setting->covid_desa) {
                $this->load->view("gis/covid_peta_local.php");
            } ?>
          </div>
        </div>
        <div class="leaflet-bottom leaflet-left">
          <div id="qrcode">
            <div class="panel-body-lg">
              <a href="https://github.com/OpenSID/OpenSID">
                <img loading="lazy" src="<?= asset("images/opensid.png") ?>" alt="OpenSID">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="modalKecil" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog relative w-auto modal-sm">
    <div class="modal-content rounded-lg">
      <div class="flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md dark:border-gray-500">
        <h4 class="modal-title font-bold modal-title text-left w-full dark:text-white" id="myModalLabel"></h4>
        <button type="button" class="w-4 h-4 inline flex items-center justify-center dark:text-white border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Tutup"><i class="ti ti-x text-xl"></i></button>
      </div>
      <div class="fetched-data px-4 py-3"></div>
    </div>
  </div>
</div>

<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="modalSedang" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog relative w-auto">
    <div class="modal-content rounded-lg">
      <div class="flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md dark:border-gray-500">
        <h4 class="modal-title font-bold modal-title text-left w-full dark:text-white" id="myModalLabel"></h4>
        <button type="button" class="w-4 h-4 inline flex items-center justify-center dark:text-white border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Tutup"><i class="ti ti-x text-xl"></i></button>
      </div>
      <div class="fetched-data px-4 py-3"></div>
    </div>
  </div>
</div>

<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="modalBesar" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog relative w-auto modal-lg">
    <div class="modal-content rounded-lg">
      <div class="flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md dark:border-gray-500">
        <h4 class="modal-title font-bold modal-title text-left w-full dark:text-white" id="myModalLabel"><i class="ti ti-exclamation-triangle text-red"></i></h4>
        <button type="button" class="w-4 h-4 inline flex items-center justify-center dark:text-white border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Tutup"><i class="ti ti-x text-xl"></i></button>
      </div>
      <div class="fetched-data px-4 py-3"></div>
    </div>
  </div>
</div>

<style>
  .btn.btn-social {
    color: #fff !important;
  }
  .table-responsive {
    overflow-x: auto;
  }
  .table-responsive tbody {
    font-size: .85rem;
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
  (function() {
    var infoWindow;
    window.onload = function() {
      <?php if (! empty($desa['lat']) && ! empty($desa['lng'])) : ?>
        var posisi = [<?= $desa['lat'] . ',' . $desa['lng'] ?>];
        var zoom = <?= $desa['zoom'] ?: 10 ?>;
      <?php elseif (! empty($desa['path'])) : ?>
        var wilayah_desa = <?= $desa['path'] ?>;
        var posisi = wilayah_desa[0][0];
        var zoom = <?= $desa['zoom'] ?: 10 ?>;
      <?php else : ?>
        var posisi = [-1.0546279422758742, 116.71875000000001];
        var zoom = 10;
      <?php endif; ?>

      var options = {
        maxZoom: <?= setting('max_zoom_peta') ?>,
        minZoom: <?= setting('min_zoom_peta') ?>,
      };

      //Inisialisasi tampilan peta
      var mymap = L.map('map', options).setView(posisi, zoom);

      <?php if (! empty($desa['path'])) : ?>
        mymap.fitBounds(<?= $desa['path'] ?>);
      <?php endif; ?>

      //Menampilkan overlayLayers Peta Semua Wilayah
      var marker_desa = [];
      var marker_dusun = [];
      var marker_rw = [];
      var marker_rt = [];
      var marker_area = [];
      var marker_garis = [];
      var marker_lokasi = [];
      var markers = new L.MarkerClusterGroup();
      var markersList = [];
      var marker_legend = [];
      var mark_desa = [];
      var mark_covid = [];

      //OVERLAY WILAYAH DESA
      <?php if (! empty($desa['path'])) : ?>
        set_marker_desa_content(marker_desa, <?= json_encode($desa) ?>, "<?= ucwords($this->setting->sebutan_desa) . ' ' . $desa['nama_desa'] ?>", "<?= favico_desa() ?>", '#isi_popup');
      <?php endif; ?>

      //OVERLAY WILAYAH DUSUN
      <?php if (! empty($dusun_gis)) : ?>
        set_marker_multi_content(marker_dusun, '<?= addslashes(json_encode($dusun_gis)) ?>', '<?= ucwords($this->setting->sebutan_dusun) ?>', 'dusun', '#isi_popup_dusun_', '<?= favico_desa() ?>');
      <?php endif; ?>

      //OVERLAY WILAYAH RW
      <?php if (! empty($rw_gis)) : ?>
        set_marker_content(marker_rw, '<?= addslashes(json_encode($rw_gis)) ?>', 'RW', 'rw', '#isi_popup_rw_', '<?= favico_desa() ?>');
      <?php endif; ?>

      //OVERLAY WILAYAH RT
      <?php if (! empty($rt_gis)) : ?>
        set_marker_content(marker_rt, '<?= addslashes(json_encode($rt_gis)) ?>', 'RT', 'rt', '#isi_popup_rt_', '<?= favico_desa() ?>');
      <?php endif; ?>

      //Menampilkan overlayLayers Peta Semua Wilayah
      var overlayLayers = overlayWil(marker_desa, marker_dusun, marker_rw, marker_rt, "<?= ucwords($this->setting->sebutan_desa) ?>", "<?= ucwords($this->setting->sebutan_dusun) ?>", true);

      //Menampilkan BaseLayers Peta
      var baseLayers = getBaseLayers(mymap, "<?= setting('mapbox_key') ?>", "<?= setting('jenis_peta') ?>");

      //Geolocation IP Route/GPS
      geoLocation(mymap);

      //Menambahkan zoom scale ke peta
      L.control.scale().addTo(mymap);

      //Mencetak peta ke PNG
      cetakPeta(mymap);

      //Menambahkan Legenda Ke Peta
      var legenda_desa = L.control({
        position: 'bottomright'
      });
      var legenda_dusun = L.control({
        position: 'bottomright'
      });
      var legenda_rw = L.control({
        position: 'bottomright'
      });
      var legenda_rt = L.control({
        position: 'bottomright'
      });

      mymap.on('overlayadd', function(eventLayer) {
        if (eventLayer.name === 'Peta Wilayah Desa') {
          setlegendPetaDesa(legenda_desa, mymap, <?= json_encode($desa) ?>, '<?= ucwords($this->setting->sebutan_desa) ?>', '<?= $desa['nama_desa'] ?>');
        }
        if (eventLayer.name === 'Peta Wilayah Dusun') {
          setlegendPeta(legenda_dusun, mymap, '<?= addslashes(json_encode($dusun_gis)) ?>', '<?= ucwords($this->setting->sebutan_dusun) ?>', 'dusun', '', '');
        }
        if (eventLayer.name === 'Peta Wilayah RW') {
          setlegendPeta(legenda_rw, mymap, '<?= addslashes(json_encode($rw_gis)) ?>', 'RW', 'rw', '<?= ucwords($this->setting->sebutan_dusun) ?>');
        }
        if (eventLayer.name === 'Peta Wilayah RT') {
          setlegendPeta(legenda_rt, mymap, '<?= addslashes(json_encode($rt_gis)) ?>', 'RT', 'rt', 'RW');
        }
      });

      mymap.on('overlayremove', function(eventLayer) {
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

      // deklrasi variabel agar mudah di baca
			var all_area = '<?= addslashes(json_encode($area)) ?>';
			var all_garis = '<?= addslashes(json_encode($garis)) ?>';
			var all_lokasi = '<?= addslashes(json_encode($lokasi)) ?>';
			var all_lokasi_pembangunan = '<?= addslashes(json_encode($lokasi_pembangunan)) ?>';
			var LOKASI_SIMBOL_LOKASI = '<?= base_url(LOKASI_SIMBOL_LOKASI) ?>';
			var favico_desa = '<?= favico_desa() ?>';
			var LOKASI_FOTO_AREA = '<?= base_url(LOKASI_FOTO_AREA) ?>';
			var LOKASI_FOTO_GARIS = '<?= base_url(LOKASI_FOTO_GARIS) ?>';
			var LOKASI_FOTO_LOKASI = '<?= base_url(LOKASI_FOTO_LOKASI) ?>';
			var LOKASI_GALERI = '<?= base_url(LOKASI_GALERI) ?>';
			var info_pembangunan = '<?= site_url('pembangunan') ?>';
			var all_persil = '<?= addslashes(json_encode($persil)) ?>';
      var TAMPIL_LUAS = <?= setting('tampil_luas_peta') ?>

      // Menampilkan OverLayer Area, Garis, Lokasi plus Lokasi Pembangunan
      var layerCustom = tampilkan_layer_area_garis_lokasi_plus(mymap, all_area, all_garis, all_lokasi, all_lokasi_pembangunan, LOKASI_SIMBOL_LOKASI, favico_desa, LOKASI_FOTO_AREA, LOKASI_FOTO_GARIS, LOKASI_FOTO_LOKASI, LOKASI_GALERI, info_pembangunan, all_persil, TAMPIL_LUAS);

      L.control.layers(baseLayers, overlayLayers, {
        position: 'topleft',
        collapsed: true
      }).addTo(mymap);
      L.control.groupedLayers('', layerCustom, {
        groupCheckboxes: true,
        position: 'topleft',
        collapsed: true
      }).addTo(mymap);

      $('#isi_popup_dusun').remove();
      $('#isi_popup_rw').remove();
      $('#isi_popup_rt').remove();
      $('#isi_popup').remove();

      $('.fa.fa-map-marker').addClass('ti ti-map-pin text-lg');

    }; //EOF window.onload

  })();
</script>
<script>
  $(document).ready(function ()
{
  $('#modalKecil').on('shown.bs.modal', function (e) {
    const link = $(event.relatedTarget);
    const title = link.data('title');
    const modal = $(this);
    modal.find('.modal-title').text(title);
    modal.find('.modal-title').text(title);
    $(this).find('.fetched-data').load(link.attr('href'));
  });

  $('#modalSedang').on('shown.bs.modal', function (e) {
    const link = $(event.relatedTarget);
    const title = link.data('title');
    const modal = $(this);
    modal.find('.modal-title').text(title);
    $(this).find('.fetched-data').load(link.attr('href'));
  });

  $('#modalBesar').on('shown.bs.modal', function (e) {
    const link = $(event.relatedTarget);
    const title = link.data('title');
    const modal = $(this);
    modal.find('.modal-title').text(title);
    $(this).find('.fetched-data').load(link.attr('href'));
  });
  return false;
})
</script>

<script src="<?= asset("js/turf.min.js") ?>"></script>
<script src="<?= asset("js/leaflet-providers.js") ?>"></script>
<script src="<?= asset("js/L.Control.Locate.min.js") ?>"></script>
<script src="<?= asset("js/leaflet-measure-path.js") ?>"></script>
<script src="<?= asset("js/leaflet.markercluster.js") ?>"></script>
<script src="<?= asset("js/leaflet.groupedlayercontrol.min.js") ?>"></script>
<script src="<?= asset("js/leaflet.browser.print.js") ?>"></script>
<script src="<?= asset("js/leaflet.browser.print.utils.js") ?>"></script>
<script src="<?= asset("js/leaflet.browser.print.sizes.js") ?>"></script>
<script src="<?= asset("js/dom-to-image.min.js") ?>"></script>
<script src="<?= asset("js/script.js") ?>"></script>