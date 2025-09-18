<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title">Daftar Calon Pemilih Berdasarkan Wilayah (pada tgl pemilihan <?= $tanggal_pemilihan ?>)</h1>

<div class="table-responsive">
  <table class="w-full text-sm">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Dusun</th>
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
            <td><?= strtoupper($data['rw']) ?></td>
            <td><?= $data['jumlah_warga'] ?></td>
            <td><?= $data['jumlah_warga_l'] ?></td>
            <td><?= $data['jumlah_warga_p'] ?></td>
          </tr>
        <?php $i = $i+$data['jumlah']; ?>
      <?php endforeach; ?>
    </tbody>
    <tfooter>
      <tr>
        <th colspan="3" class="angka">TOTAL</th>
        <th class="angka"><?= $total['total_warga']; ?></th>
        <th class="angka"><?= $total['total_warga_l']; ?></th>
        <th class="angka"><?= $total['total_warga_p']; ?></th>
      </tr>
    </tfooter>
  </table>
</div>