<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title">Album Galeri</h1>
<?php if(count($gallery ?? [])) : ?>
  <div class="gallery main-content">
    <?php foreach($gallery as $album) : ?>
      <?php $count = 0; ?>
      <?php if (file_exists(LOKASI_GALERI . "sedang_" . $album['gambar']) || $album['jenis'] == 2): 
        $image = $album['jenis'] == 2 ? $album['gambar'] : AmbilGaleri($album['gambar'], 'kecil'); 
        $count++;
      ?>
        <a href="<?= site_url("galeri/{$album['id']}") ?>" class="gallery-thumbnail h-auto">
          <img loading="lazy" src="<?= $image ?>" alt="<?= $album['nama'] ?>" class="gallery-image" title="<?= $album['nama'] ?>">
          <p class="py-2 bg-white dark:bg-dark-secondary"><?= $album['nama'] ?></p>
        </a>
      <?php endif ?>
    <?php endforeach ?>
    <?php if ($count == 0): ?>
      <p>Maaf album galeri belum tersedia</p>
    <?php endif ?>
  </div>
  <?php else : ?>
    <p>Data tidak tersedia</p>
<?php endif ?>