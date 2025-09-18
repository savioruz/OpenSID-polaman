<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title">Galeri Album <?= $parent['nama'] ?></h1>

<?php if(count($gallery ?? [])) : ?>
  <div class="gallery main-content">
    <?php foreach($gallery as $album) : ?>
      <?php $count = 0; ?>
        <?php if (file_exists(LOKASI_GALERI . "sedang_" . $album['gambar']) || $album['jenis'] == 2): 
          $image = $album['jenis'] == 2 ? $album['gambar'] : AmbilGaleri($album['gambar'], 'kecil'); 
          $count++;
        ?>
        <a href="<?= $image ?>" data-fancybox="images" data-caption="<?= $data['nama'] ?>" class="gallery-thumbnail">
          <img loading="lazy" src="<?= $image ?>" alt="<?= $album['nama'] ?>" class="gallery-image" title="<?= $album['nama'] ?>">
        </a>
      <?php endif ?>
    <?php endforeach ?>
  </div>
  <?php else : ?>
    <p>Data tidak tersedia</p>
<?php endif ?>