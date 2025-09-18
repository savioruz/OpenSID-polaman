<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title">Galeri Album <a href="<?= site_url('first/gallery') ?>" class="text-link with-underline"><?= $parent['nama'] ?></a></h1>

<?php if($gallery) : ?>
  <div class="gallery main-content">
    <?php foreach($gallery as $album) : ?>
      <?php if(is_file(LOKASI_GALERI . "kecil_" . $album['gambar'])) : ?>
        <?php $link = AmbilGaleri($album['gambar'],'sedang') ?>
        <a href="<?= $link ?>" data-fancybox="images" data-caption="<?= $data['nama'] ?>" class="gallery-thumbnail">
          <img loading="lazy" src="<?= AmbilGaleri($album['gambar'],'kecil') ?>" alt="<?= $album['nama'] ?>" class="gallery-image" title="<?= $album['nama'] ?>">
        </a>
      <?php endif ?>
    <?php endforeach ?>
  </div>
<?php endif ?>