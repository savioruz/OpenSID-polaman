<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><?= $title ?></h1>

<p><?= $detail['keterangan'] ?></p>
<h3 class="text-heading text-base lg:text-xl">Daftar Pengurus</h3>
<div class="table-responsive">
  <table class="w-full text-sm">
    <thead>
      <tr>
        <th>No</th>
        <th>Jabatan</th>
        <th>Nama</th>
        <th>Alamat</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pengurus as $key => $data): ?>
        <tr>
          <td><?= $key + 1?></td>
          <td><?= $data['jabatan'] ?></td>
          <td nowrap><?= $data['nama']?></td>
          <td><?= $data['alamat']?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<h3 class="text-heading text-base lg:text-xl">Daftar Anggota</h3>
<div class="table-responsive">
  <table class="w-full text-sm">
    <thead>
      <tr>
        <th>No</th>
        <th>No. Anggota</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($anggota as $key => $data): ?>
      <tr>
        <td><?= $key + 1?></td>
        <td><?= $data['no_anggota'] ?:'-'?></td>
        <td nowrap><?= $data['nama'] ?></td>
        <td><?= $data['alamat'] ?></td>
        <td><?= $data['sex'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>