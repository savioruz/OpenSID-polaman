<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title">Album Galeri</h1>
<?php if($gallery) : ?>
  <div class="gallery main-content">
    <?php foreach($gallery as $album) : ?>
      <?php if(is_file(LOKASI_GALERI . "kecil_" . $album['gambar'])) : ?>
        <?php $link = IS_PREMIUM ? site_url("galeri/{$album['id']}") : site_url('first/sub_gallery/'.$album['id']) ?>
        <a href="<?= $link ?>" class="gallery-thumbnail h-auto">
          <img loading="lazy" src="<?= AmbilGaleri($album['gambar'],'kecil') ?>" alt="<?= $album['nama'] ?>" class="gallery-image" title="<?= $album['nama'] ?>">
          <p class="py-2 bg-white dark:bg-dark-secondary"><?= $album['nama'] ?></p>
        </a>
      <?php endif ?>
    <?php endforeach ?>
  </div>
<?php endif ?>