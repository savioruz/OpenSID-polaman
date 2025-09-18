<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div id="isi_popup" class="invisible">
  <div id="content">
    <h5 id="firstHeading" class="text-lg lg:text-xl font-bold">Wilayah <?= set_ucwords($wilayah); ?></h5>
    <div id="bodyContent" class="px-2 py-4 font-body text-sm">
      <?php $pengaturan = json_decode(setting('tampilkan_tombol_peta'), true) ?>
      <!-- statistik penduduk -->
      <?php if (in_array('Statistik Penduduk', $pengaturan)) : ?>
        <button type="button" class="button button-primary w-full block my-2" title="Statistik Penduduk" data-bs-toggle="collapse" data-bs-target="#collapseStatGraph" aria-expanded="false" aria-controls="collapseStatGraph" data-mdb-ripple="true" data-mdb-ripple-color="light">
          <i class="ti ti-chart-bar mr-2"></i>Statistik Penduduk
        </button>
        <div class="collapse box-body no-padding" id="collapseStatGraph">
          <div class="w-full divide-y dark:divide-dark-primary text-sm">
            <?php foreach ($list_ref as $key => $value) : ?>
              <li <?= jecho($lap, $key, 'class="active"'); ?>><a class="py-1 block" href="<?= site_url("statistik_web/chart_gis_desa/{$key}/" . underscore($desa['nama_desa'])) ?>" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#modalSedang" data-title="Statistik Penduduk <?= set_ucwords($wilayah) ?>"><?= $value ?></a></li>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif ?>

      <!-- statistik bantuan -->
      <?php if (in_array('Statistik Bantuan', $pengaturan)) : ?>
        <button type="button" class="button button-primary w-full block my-2" title="Statistik Bantuan" data-bs-toggle="collapse" data-bs-target="#collapseStatBantuan" aria-expanded="false" aria-controls="collapseStatBantuan" data-mdb-ripple="true" data-mdb-ripple-color="light">
          <i class="ti ti-chart-bar mr-2"></i>Statistik Bantuan
        </button>
        <div class="collapse box-body no-padding" id="collapseStatBantuan">
          <div class="w-full divide-y dark:divide-dark-primary text-sm">
            <?php foreach ($list_bantuan as $key => $value) : ?>
              <li <?= jecho($lap, $key, 'class="active"'); ?>><a class="py-1 block" href="<?= site_url("statistik_web/chart_gis_desa/{$key}/" . underscore($desa['nama_desa'])) ?>" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#modalSedang" data-title="Statistik Bantuan <?= set_ucwords($wilayah) ?>"><?= $value ?></a></li>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif ?>

      <!-- statistik aparatur-->
      <?php if (in_array('Aparatur Desa', $pengaturan)) : ?>
        <a href="<?= site_url('load_aparatur_desa'); ?>" class="button button-primary w-full block my-2 text-center !text-white" data-title="Aparatur <?= ucwords($this->setting->sebutan_desa) ?>" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#modalKecil" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-user mr-2"></i>Aparatur
          <?= ucwords($this->setting->sebutan_desa) ?></a>
      <?php endif ?>

      <!-- statistik apbdes -->
      <?php if (in_array('Aparatur Desa', $pengaturan)) : ?>
        <a href="<?= site_url('load_apbdes'); ?>" class="button button-primary w-full block my-2 text-center !text-white" data-title="Laporan APBDES <?= $transparansi['tahun'] ?> - Grafik" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#modalSedang" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-chart-bar mr-2"></i>Grafik Keuangan</a>
      <?php endif ?>
    </div>
  </div>
</div>