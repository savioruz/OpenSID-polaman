<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title">Arsip Konten Situs Web <?= $desa['nama_desa'] ?></h1>
<?php if(count($farsip) > 0) : ?>
  <ol class="divide-y space-y-3 mb-5">
    <?php foreach($farsip AS $data): ?>
      <li class="py-3">
        <span class="ti ti-external-link mr-2"></span>
        <a class="text-link text-heading" href="<?= site_url('artikel/'.buat_slug($data))?>"><?= $data["judul"]?></a>
        <p class="text-sm">Diterbitkan pada <?= tgl_indo($data["tgl_upload"])?></p>
        <p class="text-sm">Oleh: <?= $data["owner"]?></p>
      </li>
    <?php endforeach; ?>
  </ol>
    <?php else: ?>
      <p>Belum ada arsip konten web.</p>
<?php endif ?>