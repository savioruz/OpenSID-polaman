<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php if($artikel) : ?>
  <?php $latest_article = array_slice($artikel, 0, 1) ? array_slice($artikel, 0, 1)[0] : NULL ?>
  <?php $headline = ($headline ?? $latest_article) ?>
  <?php $abstrak_headline = potong_teks($headline['isi'], 250); ?>
  <?php $url = site_url('artikel/'.buat_slug($headline)); ?>
  <?php $image = ($headline['gambar'] && is_file(LOKASI_FOTO_ARTIKEL.'sedang_'.$headline['gambar'])) ?
    AmbilFotoArtikel($headline['gambar'],'sedang') :
    gambar_desa($desa['logo']);
  ?>

  <?php if($headline) : ?> 
    <article class="flex flex-col gap-3">
      <div class="flex-shrink-0 w-full h-auto rounded-lg  <?php $image === gambar_desa($desa['logo']) and print('flex items-center') ?>" style="background: transparent">
        <img loading="lazy" src="<?= $image ?>" alt="<?= $headline['judul'] ?>" class="<?php $image !== gambar_desa($desa['logo']) and print('article-image') ?> mx-auto">
      </div>
      <div class="flex flex-col justify-between space-y-2">
        <div class="space-y-1">
          <a href="<?= $url ?>" class="text-heading lg:text-lg block"><?= $headline['judul'] ?></a>
          <p class="text-sm"><?= $abstrak_headline ?>..</p>
        </div>
        <a href="<?= $url ?>" class="button button-secondary w-36 text-sm" data-mdb-ripple="true" data-mdb-ripple-color="light">Selengkapnya <span class="icon icon-base me-2 inline ti ti-chevron-right"></span></a>
      </div>
    </article>
  <?php endif ?>
<?php endif ?>