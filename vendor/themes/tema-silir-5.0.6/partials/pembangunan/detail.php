<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="py-4 px-5 main-content">
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i class="ti ti-package inline-block mr-1"></i> <?= $pembangunan->judul ?></h1>

  <div class="flex flex-col lg:flex-row justify-between lg:space-x-4 py-5">
    <div class="w-full px-2">
      <?php if($pembangunan->foto && is_file(LOKASI_GALERI . $pembangunan->foto)) : ?>
        <img loading="lazy" class="h-auto w-full" src="<?= base_url() . LOKASI_GALERI . $pembangunan->foto ?>" alt="Foto Pembangunan"/>
        
        <?php else: ?>
        <img loading="lazy" class="h-auto w-full" src="<?= base_url('assets/images/404-image-not-found.jpg') ?>" alt="Tidak ditemukan"/>
      <?php endif ?>

      <div class="table-responsive py-5">
        <table class="w-full">
          <tr>
            <th width="150px">Nama Kegiatan</th>
            <td width="20px">:</td>
            <td><?= $pembangunan->judul ?></td>
          </tr>
          <tr>
            <th>Alamat</th>
            <td width="20px">:</td>
            <td><?= $pembangunan->alamat ?></td>
          </tr>
          <tr>
            <th>Sumber Dana</th>
            <td width="20px">:</td>
            <td><?= $pembangunan->sumber_dana ?></td>
          </tr>
          <tr>
            <th>Anggaran</th>
            <td width="20px">:</td>
            <td>Rp. <?= number_format($pembangunan->anggaran,0) ?></td>
          </tr>
          <tr>
            <th>Volume</th>
            <td width="20px">:</td>
            <td><?= $pembangunan->volume?></td>
          </tr>
          <tr>
            <th>Pelaksana</th>
            <td width="20px">:</td>
            <td><?= $pembangunan->pelaksana_kegiatan ?></td>
          </tr>
          <tr>
            <th>Tahun</th>
            <td width="20px">:</td>
            <td><?= $pembangunan->tahun_anggaran ?></td>
          </tr>
          <tr>
            <th>Keterangan</th>
            <td width="20px">:</td>
            <td><?= $pembangunan->keterangan ?></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="w-full px-2">
      <h3 class="font-heading text-lg">Progres Pembangunan</h3>
      <hr>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <?php foreach ($dokumentasi as $value): ?>
          <div class="w-full text-center py-2">
            <?php if (is_file(LOKASI_GALERI . $value->gambar)): ?>
              <img loading="lazy" width="auto" class="h-auto w-full" src="<?= base_url(LOKASI_GALERI . $value->gambar); ?>" alt="Foto Pembangunan <?= $value->persentase; ?>"/>
            <?php else: ?>
              <img loading="lazy" width="auto" class="h-auto w-full" src="<?= base_url('assets/images/404-image-not-found.jpg') ?>" alt="Foto Pembangunan <?= $value->persentase; ?>"/>
            <?php endif; ?>
            <b>Foto Pembangunan <?= $value->persentase; ?></b>
          </div>
        <?php endforeach; ?>
        <?php if(!$dokumentasi) : ?>
          <p class="mb-5">Belum ada dokumentasi.</p>
        <?php endif ?>
      </div>

      <div class="mt-5">
        <h3 class="font-heading text-lg">Lokasi Pembangunan</h3>
        <hr>
        <div id="map" style="max-width: 100%; max-height: 340px"></div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    let map_key = "<?= $this->setting->mapbox_key; ?>";
    let lat = "<?= $pembangunan->lat ?? $desa['lat']; ?>";
    let lng = "<?= $pembangunan->lng ?? $desa['lng']; ?>";
    let posisi = [lat, lng];
    let zoom = "<?= $desa['zoom'] ?? 10 ?>";
    let logo = L.icon({
      iconUrl: "<?= base_url('assets/images/gis/point/construction.png'); ?>",
    });

    pembangunan = L.map('map').setView(posisi, zoom);
    getBaseLayers(pembangunan, map_key);
    pembangunan.addLayer(new L.Marker(posisi, {icon:logo}));
  });
</script>