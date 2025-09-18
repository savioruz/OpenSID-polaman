<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="py-4 px-5">
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i class="ti ti-box inline-block mr-1"></i> Pembangunan</h1>

  <div class="bg-slate-200 dark:bg-dark-primary py-3 px-5 border-l-4 border-secondary my-5 space-y-3">
    <p class="text-sm text-justify">Laman pembangunan ini memuat informasi kegiatan pembangunan yang dilaksanakan di <?= $this->setting->sebutan_desa ?> dengan tujuan untuk mempermudah <?= $this->setting->sebutan_desa ?> dalam menyampaikan informasi tentang program pembangunan atau progres pembangunan di <?= $this->setting->sebutan_desa ?></p>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-4 gap-5 py-5">
    <?php if($pembangunan) : ?>
      <?php foreach($pembangunan as $data) : ?>
        <div class="card p-4 flex flex-col justify-between space-y-4 border border-slate-300 dark:border-slate-300 this-product">
          <div class="space-y-3">
            <?php if($data->foto && is_file(LOKASI_GALERI . $data->foto)) : ?>
              <img loading="lazy" class="h-44 w-full object-cover object-center bg-slate-300 dark:bg-slate-600" src="<?= base_url() . LOKASI_GALERI . $data->foto ?>" alt="Foto Pembangunan"/>
              
              <?php else: ?>
                <img loading="lazy" class="h-44 w-full object-cover object-center bg-slate-300 dark:bg-slate-600" src="<?= base_url('assets/images/404-image-not-found.jpg') ?>" alt="Tidak ditemukan"/>
            <?php endif ?>
            
            <div class="space-y-2 text-sm flex flex-col detail">
              <h3 class="font-heading font-bold text-base"><?= $data->judul ?></h3>
              <div class="inline-flex"><i class="ti ti-calendar inline-block mr-1"></i> <?= $data->tahun_anggaran ?></div>
              <div class="font-thin">
                <i class="ti ti-map-pin inline-block mr-1"></i> 
                <?= ($data->alamat == "=== Lokasi Tidak Ditemukan ===") ? 'Lokasi tidak diketahui' : $data->alamat; ?>
              </div>
              <p class="text-sm pt-1">
                <?= $data->keterangan ?>
              </p>
            </div>
          </div>
          <div class="group flex items-center space-x-1">
            <a href="<?= site_url('pembangunan/'.$data->slug) ?>" class="button button-primary text-xs text-center rounded-0" data-mdb-ripple="true" data-md-ripple-color="light">Selengkapnya <i class="ti ti-chevron-right inline-block ml-1"></i> </a>
            <?php if($data->lat && $data->lng) : ?>
              <button type="button" class="button button-secondary text-xs text-center rounded-0" data-mdb-ripple="true" data-md-ripple-color="light" data-bs-toggle="modal" data-bs-target="#map-modal" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#map-modal" title="Lokasi" data-lat="<?= $data->lat?>" data-lng="<?= $data->lng?>" data-title="Lokasi <?= $data->pelapak?>"><i class="ti ti-map-pin inline-block mr-1"></i> Lokasi</button>
            <?php endif ?>
          </div>
        </div>
      <?php endforeach ?>
    </div>
    
    <?php $p_data['paging_page'] = ($paging_page ?? 'pembangunan') ?>
    <?php $this->load->view($folder_themes .'/commons/paging', $p_data) ?>
      
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="map-modal" tabindex="-1" role="dialog" aria-labelledby="modalLokasi" aria-hidden="true">
      <div class="modal-dialog relative w-auto">
        <div class="modal-content rounded-lg">
          <div class="modal-header px-4 py-3 flex flex-row-reverse items-center justify-between text-left text-slate-800">
            <button type="button" class="btn-close box-content w-4 h-4 p-1 text-inherit border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:no-underline" data-bs-dismiss="modal" aria-label="Tutup"></button>
            <h4 class="modal-title text-left w-full dark:text-white"></h4>
          </div>
          <div class="modal-body relative">
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      var token = "<?= $this->setting->mapbox_key; ?>";

      $(document).ready(function () {
        $(document).on('shown.bs.modal', '#map-modal', function (event) {
          const link = $(event.relatedTarget);
          const title = link.data('title');
          const modal = $(this);
          modal.find('.modal-title').text(title);
          modal.find('.modal-body').html("<div id='map' style='width: 100%;'></div>");

          const popup = `
                <div class="group">
                  <div class="space-y-2 text-xs">
                    <img loading="lazy" src=${link.closest('.this-product').find('img:nth-child(1)').attr('src')} alt="produk" class="h-44 w-full object-cover object-center bg-slate-300 dark:bg-slate-600" style="min-width: 14rem;">
                    <div class="py-2 space-y-1/2 text-sm flex flex-col">
                      ${link.closest('.this-product').find('.detail').html()}
                    </div>
                  </div>
                </div>`;

          const posisi = [link.data('lat'), link.data('lng')];
          const zoom = 10;
          $("#lat").val(link.data('lat'));
          $("#lng").val(link.data('lng'));

          // Inisialisasi tampilan peta
          pembangunan = L.map('map').setView(posisi, zoom);

          // Menampilkan BaseLayers Peta
          getBaseLayers(pembangunan, token);

          // Tampilkan Posisi pembangunan
          marker = new L.Marker(posisi, {
            draggable: false
          });

          pembangunan.addLayer(marker);
          L.icon({
            iconUrl: "<?= base_url('assets/images/gis/point/construction.png'); ?>",
          });
          L.marker(posisi).addTo(pembangunan).bindPopup(popup).openPopup();
          L.control.scale().addTo(pembangunan);
          pelapak.invalidateSize();
        });
      });
    </script>
    <?php else : ?>
      <p class="py-2">Data pembangunan tidak tersedia...</p>
  <?php endif ?>
</div>
