<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php if($teks_berjalan) : ?>
  <div class="newsticker rounded-none text-sm">
    <h3 class="newsticker-heading py-1"><i class="ti ti-speakerphone text-lg"></i> <span class="newsticker-title">Sekilas Info</span></h3>
    <ul class="newsticker-list py-1">
      <?php foreach($teks_berjalan as $newsticker) : ?>
        <li class="newsticker-item">
          <?= $newsticker['teks'] ?>
          <?php if($newsticker['tautan']) : ?>
          <a href="<?= $newsticker['tautan'] ?>" class="newsticker-link"><i class=" ti ti-link icon icon-sm mr-2"></i> <?= $newsticker['judul_tautan']?></a>
          <?php endif ?>
        </li>
      <?php endforeach ?>
    </ul>
  </div>
<?php endif ?>