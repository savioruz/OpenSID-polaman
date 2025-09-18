<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<script>
  const dataStats = Object.values(<?= json_encode($stat) ?>);
</script>

<h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title">Demografi Berdasar <?= $heading ?></h1>

<div class="flex justify-between items-center space-x-1">
  <h3 class="text-heading text-base lg:text-xl w-auto">Grafik <?= $heading ?></h3>
  <div class="text-right space-x-2 text-sm space-y-2 md:space-y-0">
    <button class="button button-secondary button-switch" data-type="column" data-mdb-ripple="true" data-md-ripple-color="light">Bar Graph</button>
    <button class="button button-secondary button-switch is-active" data-type="pie" data-mdb-ripple="true" data-md-ripple-color="light">Pie Graph</button>
  </div>
</div>

<div id="statistics"></div>

<h3 class="text-heading text-base lg:text-xl">Tabel <?= $heading ?></h3>
<div class="table-responsive">
  <table class="w-full text-sm">
    <thead>
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Kelompok</th>
        <th colspan="2">Jumlah</th>
        <th colspan="2">Laki-laki</th>
        <th colspan="2">Perempuan</th>
      </tr>
      <tr>
        <th>n</th>
        <th>%</th>
        <th>n</th>
        <th>%</th>
        <th>n</th>
        <th>%</th>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; $l=0; $p=0; $hide=''; $h=0; $jm1=1; $jm = count($stat);?>
      <?php foreach ($stat as $data):?>
        <?php $jm1++; if (1):?>
        <?php $h++; if ($h > 12 AND $jm > 10): $hide='more'; ?>
        <?php endif;?>
        <tr class="<?=$hide?>">
          <td class="text-center">
            <?php if ($jm1 > $jm - 2):?>
              <?=$data['no']?>
            <?php else:?>
              <?=$h?>
            <?php endif;?>
          </td>
          <td><?=$data['nama']?></td>
          <td class="text-right <?php ($jm1 <= $jm - 2) and ($data['jumlah'] == 0) and print('zero')?>"><?=$data['jumlah']?>
          </td>
          <td class="text-right"><?=$data['persen']?></td>
          <td class="text-right"><?=$data['laki']?></td>
          <td class="text-right"><?=$data['persen1']?></td>
          <td class="text-right"><?=$data['perempuan']?></td>
          <td class="text-right"><?=$data['persen2']?></td>
        </tr>
        <?php $i += $data['jumlah'];?>
        <?php $l += $data['laki']; $p += $data['perempuan'];?>
        <?php endif;?>
      <?php endforeach;?>
    </tbody>
  </table>
  <?php if(IS_PREMIUM) : ?>
    <p class="text-sm text-red-500">
      Diperbarui pada : <?= tgl_indo($last_update); ?>
    </p>
  <?php endif ?>
</div>
<div class="flex justify-between">
  <?php if($hide == 'more') : ?>
    <button class="button button-primary button-more" id="showData" data-mdb-ripple="true" data-md-ripple-color="light">Selengkapnya...</button>
  <?php endif ?>
  <button id="showZero" class="button button-secondary" data-mdb-ripple="true" data-md-ripple-color="light">Tampilkan Nol</button>
</div>

<?php $is_shown = IS_PREMIUM ? ($this->setting->daftar_penerima_bantuan && $bantuan) : (in_array($st, array('bantuan_keluarga', 'bantuan_penduduk'))) ?>
<?php if ($is_shown):?>
  <script>
  const bantuanUrl = '<?= site_url('first/ajax_peserta_program_bantuan')?>';
  </script>

  <input id="stat" type="hidden" value="<?=$st?>">
  <h3 class="text-heading text-base lg:text-xl">Daftar <?= $heading ?></h3>

  <div class="table-responsive">
    <table class="w-full text-sm" id="peserta_program">
      <thead>
        <tr>
          <th>No</th>
          <th>Program</th>
          <th>Nama Peserta</th>
          <th>Alamat</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
<?php endif;?>