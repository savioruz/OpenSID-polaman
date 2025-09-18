<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title">Demografi Berdasarkan Hak Pilih</h1>

<?php if($heading) : ?>
  <div class="bg-slate-200 dark:bg-dark-primary py-3 px-5 border-l-4 border-secondary my-5 space-y-3">
    <p class="text-sm text-justify"><?= $heading ?></p>
  </div>
<?php endif ?>

<div class="table-responsive">
  <table class="w-full text-sm">
    <thead>
      <tr>
        <th>No</th>
        <th><?= ucwords(setting('sebutan_dusun')) ?></th>
        <th>RW</th>
        <th>Jiwa</th>
        <th>Lk</th>
        <th>Pr</th>
      </tr>
    </thead>
    <tbody>
      <?php $i=0; ?>
        <?php foreach($main as $data): ?>
          <tr>
            <td class="text-center"><?= $data['no'] ?></td>
            <td><?= strtoupper($data['dusun']) ?></td>
            <td class="text-center"><?= strtoupper($data['rw']) ?></td>
            <td class="text-right"><?= $data['jumlah_warga'] ?></td>
            <td class="text-right"><?= $data['jumlah_warga_l'] ?></td>
            <td class="text-right"><?= $data['jumlah_warga_p'] ?></td>
          </tr>
        <?php $i = $i+$data['jumlah']; ?>
      <?php endforeach; ?>
    </tbody>
    <tfooter>
      <tr>
        <th colspan="3" class="angka">TOTAL</th>
        <th class="text-right"><?= $total['total_warga']; ?></th>
        <th class="text-right"><?= $total['total_warga_l']; ?></th>
        <th class="text-right"><?= $total['total_warga_p']; ?></th>
      </tr>
    </tfooter>
  </table>
</div>
<p class="text-sm text-slate-500 py-2">
  Tanggal Pemilihan : <?= $tanggal_pemilihan ?>
</p>