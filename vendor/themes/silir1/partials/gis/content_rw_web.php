<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php $pengaturan = json_decode(setting('tampilkan_tombol_peta'), true) ?>

<div id="isi_popup_rw">
  <?php foreach ($rw_gis as $key_rw => $rw) : ?>
    <div id="isi_popup_rw_<?= $key_rw ?>" class="invisible">
      <div id="content">
        <h5 id="firstHeading" class="text-lg lg:text-xl font-bold">Wilayah RW <?= set_ucwords($rw['rw']) . ' ' . ucwords($this->setting->sebutan_dusun) . ' ' . set_ucwords($rw['dusun']); ?>
        </h5>
        <div id="bodyContent" class="px-2 py-4 font-body text-sm">
          
          <?php if(IS_PREMIUM) : ?>
            <!-- statistik penduduk -->
            <?php if (in_array('Statistik Penduduk', $pengaturan)) : ?>
              <button type="button" class="button button-primary w-full block my-2" title="Statistik Penduduk" data-bs-toggle="collapse" data-bs-target="#collapseStatGraph" aria-expanded="false" aria-controls="collapseStatGraph" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-chart-bar mr-2"></i>Statistik
                Penduduk</button>
              <div class="collapse box-body no-padding" id="collapseStatGraph">
                <div class="w-full divide-y dark:divide-dark-primary text-sm">
                  <?php foreach ($list_ref as $key => $value) : ?>
                    <li <?= jecho($lap, $key, 'class="active"'); ?>><a class="py-1 block" href="<?= site_url("statistik_web/chart_gis_rw/{$key}/" . underscore($rw['dusun']) . '/' . underscore($rw['rw'])) ?>" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#modalSedang" data-title="Statistik Penduduk RW <?= set_ucwords($rw['rw']) . ' ' . set_ucwords($wilayah) . set_ucwords($rw['dusun']) ?>"><?= $value ?></a>
                    </li>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif ?>

            <!-- statistik bantuan -->
            <?php if (in_array('Statistik Bantuan', $pengaturan)) : ?>
              <button type="button" class="button button-primary w-full block my-2" title="Statistik Bantuan" data-bs-toggle="collapse" data-bs-target="#collapseStatBantuan" aria-expanded="false" aria-controls="collapseStatBantuan" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-chart-bar mr-2"></i>Statistik
                Penduduk</button>
              <div class="collapse box-body no-padding" id="collapseStatBantuan">
                <div class="w-full divide-y dark:divide-dark-primary text-sm">
                  <?php foreach ($list_bantuan as $key => $value) : ?>
                    <li <?= jecho($lap, $key, 'class="active"'); ?>><a class="py-1 block" href="<?= site_url("statistik_web/chart_gis_rw/{$key}/" . underscore($rw['dusun']) . '/' . underscore($rw['rw'])) ?>" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#modalSedang" data-title="Statistik Bantuan RW <?= set_ucwords($rw['rw']) . ' ' . set_ucwords($wilayah) . set_ucwords($rw['dusun']) ?>"><?= $value ?></a>
                    </li>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif ?>

            <!-- statistik aparatur -->
            <?php if (in_array('Kepala Wilayah', $pengaturan)) : ?>
              <a href="<?= site_url("load_aparatur_wilayah/{$rw['id_kepala']}/2"); ?>" class="button button-primary w-full block my-2 text-center !text-white" data-title="Ketua RW <?= set_ucwords($rw['rw']) ?>" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#modalKecil" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-user mr-2"></i>Ketua RW</a>
            <?php endif ?>
            
            <?php else : ?>
              <button type="button" class="button button-primary w-full block my-2"
                title="Statistik Penduduk" data-bs-toggle="collapse" data-bs-target="#collapseStatGraph" aria-expanded="false"
                aria-controls="collapseStatGraph"
                data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-chart-bar mr-2"></i>Statistik
                Penduduk</button>
              <div class="collapse box-body no-padding" id="collapseStatGraph">
                <div class="w-full divide-y dark:divide-dark-primary text-sm">
                  <?php foreach ($list_ref as $key => $value): ?>
                  <li <?= jecho($lap, $key, 'class="active"'); ?>><a class="py-1 block"
                      href="<?= site_url("statistik_web/chart_gis_rw/{$key}/" . underscore($rw['dusun']) . '/' . underscore($rw['rw'])) ?>"
                      data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#modalSedang"
                      data-title="Statistik Penduduk RW <?= set_ucwords($rw['rw']) . ' ' . set_ucwords($wilayah) . set_ucwords($rw['dusun']) ?>"><?= $value ?></a>
                  </li>
                  <?php endforeach; ?>
                </div>
              </div>
              <a href="<?= site_url("load_aparatur_wilayah/{$rw['id_kepala']}/2"); ?>"
                class="button button-primary w-full block my-2 text-center !text-white"
                data-title="Ketua RW <?= set_ucwords($rw['rw'])?>" data-bs-remote="false" data-bs-toggle="modal"
                data-bs-target="#modalKecil"
                data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-user mr-2"></i>Ketua
                RW</a>
          <?php endif ?>

        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>