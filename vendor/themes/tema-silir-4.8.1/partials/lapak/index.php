<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="py-4 px-5">
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i class="ti ti-shopping-bag inline-block mr-1"></i> Lapak <?= ucwords($this->setting->sebutan_desa) ?></h1>
  <div class="bg-slate-200 dark:bg-dark-primary py-3 px-5 border-l-4 border-secondary my-5 space-y-3">
    <p class="text-sm text-justify">Lapak <?= ucwords($this->setting->sebutan_desa) ?> atau Pasar <?= ucwords($this->setting->sebutan_desa) ?> Online merupakan media promosi produk lokal <?= $this->setting->sebutan_desa ?> yang bertujuan untuk membantu warga <?= $this->setting->sebutan_desa ?> dalam memasarkan dan memperkenalkan produknya kepada masyarakat luas</p>
  </div>
  <form method="get" class="w-full block py-2">
    <div class="flex gap-3 lg:w-7/12 flex-col lg:flex-row">
      <select class="form-input inline-block select2" id="id_kategori" name="id_kategori" style="min-width: 25%">
        <option selected value="">Semua Kategori</option>
        <?php foreach ($kategori as $kategori_item) : ?>
          <option value="<?= $kategori_item->id ?>" <?= selected($id_kategori, $kategori_item->id) ?>><?= $kategori_item->kategori ?></option>
        <?php endforeach; ?>
      </select>
      <input type="text" name="keyword" maxlength="50" class="form-input" value="<?= htmlentities($keyword); ?>" placeholder="Cari Produk" style="min-width: 25%">
      <button type="submit" class="button button-primary flex-shrink-0 text-center" data-mdb-ripple="true" data-md-ripple-color="light">Cari</button>
      <?php if ($keyword): ?>
        <a href="<?=site_url('lapak')?>" class="button button-secondary flex-shrink-0 text-center" data-mdb-ripple="true" data-md-ripple-color="light">Tampilkan Semua</a>
      <?php endif ?>
    </div>
  </form>

  <?php if($produk) : ?>
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-5 py-5">
      <?php foreach($produk as $in => $pro) : ?>
        <?php $foto = json_decode($pro->foto); ?>
        <div class="card p-4 flex flex-col justify-between space-y-4 border border-slate-300 dark:border-slate-300 this-product">
          <div class="space-y-3">
            <?php if($pro->foto) : ?>
              <div class="owl-carousel one-carousel">
                <?php for ($i = 0; $i < $this->setting->banyak_foto_tiap_produk; $i++): ?>
                  <?php if ($foto[$i]): ?>
                    <?php if (is_file(LOKASI_PRODUK . $foto[$i])): ?>
                      <img loading="lazy" src="<?= base_url(LOKASI_PRODUK . $foto[$i]); ?>" alt="Foto <?= ($i+1); ?>" class="h-44 w-full object-cover object-center bg-slate-300 dark:bg-slate-600">
                    <?php endif; ?>
                  <?php endif; ?>
                <?php endfor; ?>
              </div>
              <?php else: ?>
                <img loading="lazy" class="h-44 w-full object-cover object-center bg-slate-300 dark:bg-slate-600" src="<?= base_url('assets/images/404-image-not-found.jpg') ?>" alt="Foto Produk"/>
            <?php endif ?>
            <div class="space-y-1/2 text-sm flex flex-col detail">
              <span class="font-heading font-medium"><?= $pro->nama ?></span>
              <?php $harga_potongan = ($pro->tipe_potongan == 1) ? ($pro->harga * ($pro->potongan / 100)) : $pro->potongan; ?>
              <?php if($pro->potongan != 0) : ?>
                <s class="text-xs text-red-500"><?= rupiah($pro->harga); ?></s>
              <?php endif ?>
              <span class="text-lg font-bold"><?= rupiah($pro->harga - $harga_potongan); ?> <span class="text-xs font-thin">/ <?= $pro->satuan ?></span></span>
              <p class="text-xs pt-1">
                <?= $pro->deskripsi ?>
              </p>
              <span class="pt-2 text-xs font-bold text-slate-500 dark:text-slate-50">
                <i class="ti ti-award inline-block mr-1"></i> <?= $pro->pelapak ?? 'Admin'; ?> <i class="ti ti-check inline-block text-secondary"></i></span>
            </div>
          </div>
          <div class="group flex items-center space-x-1">
            <?php if ($pro->telepon): ?>
              <?php $pesan = strReplaceArrayRecursive(['[nama_produk]' => $pro->nama, '[link_web]' => base_url('lapak'), '<br />' => "%0A"], nl2br($this->setting->pesan_singkat_wa)); ?>
              <a href="https://api.whatsapp.com/send?phone=<?=format_telpon($pro->telepon);?>&amp;text=<?= $pesan; ?>" rel="noopener noreferrer" target="_blank" class="button button-primary text-xs text-center" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-shopping-cart inline-block mr-1"></i> Beli Sekarang</a>
            <?php endif; ?>
            <button type="button" class="button button-secondary text-xs text-center rounded-0" data-mdb-ripple="true" data-md-ripple-color="light" data-bs-toggle="modal" data-bs-target="#map-modal" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#map-modal" title="Lokasi" data-lat="<?= $pro->lat?>" data-lng="<?= $pro->lng?>" data-zoom="<?= $pro->zoom?>" data-title="Lokasi <?= $pro->pelapak?>"><i class="ti ti-map-pin inline-block mr-1"></i> Lokasi</button>
          </div>
        </div>
      <?php endforeach ?>
    </div>
    <?php $data['paging_page'] = ($paging_page ?? 'lapak') ?>
    <?php $this->load->view($folder_themes .'/commons/paging', $data) ?>
    <?php else : ?>
      <p class="py-2">Tidak ada produk yang tersedia</p>
  <?php endif ?>
</div>
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
      const zoom = link.data('zoom');
      $("#lat").val(link.data('lat'));
      $("#lng").val(link.data('lng'));

      // Inisialisasi tampilan peta
      pelapak = L.map('map').setView(posisi, zoom);

      // Menampilkan BaseLayers Peta
      getBaseLayers(pelapak, token);

      // Tampilkan Posisi Pelapak
      marker = new L.Marker(posisi, {
        draggable: false
      });

      pelapak.addLayer(marker);
      L.marker(posisi).addTo(pelapak).bindPopup(popup).openPopup();
      L.control.scale().addTo(pelapak);
      pelapak.invalidateSize();
    });
  });
</script>