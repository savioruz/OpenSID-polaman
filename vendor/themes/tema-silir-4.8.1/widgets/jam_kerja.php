<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
  .jam-kerja td, .jam-kerja th {
    border: 1px solid #eee;
    padding: 5px 8px;
  }
  .jam-kerja tr {
    border: 1px solid #eee;
  }
  .jam-kerja tr:nth-child(even) {
    background-color: #efefef;
  }
  .dark .jam-kerja tr:nth-child(even) {
    background-color: #1a202c;
  }
  .jam-kerja th {
    background-color: var(--primary-color);
    color: #fff;
  }
</style>
<?php if ($jam_kerja) : ?>
  <table class="w-full table border text-center jam-kerja" cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th>Hari</th>
        <th>Mulai</th>
        <th>Selesai</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($jam_kerja as $value) : ?>
      <tr>
        <td><?= $value->nama_hari ?></td>
        <?php if ($value->status) : ?>
          <td><?= $value->jam_masuk ?></td>
          <td><?= $value->jam_keluar ?></td>
        <?php else : ?>
          <td colspan="2"><span class="label label-danger"> Libur </span></td>
        <?php endif ?>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
<?php endif ?>