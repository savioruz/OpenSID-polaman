<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php $url = site_url('artikel/'.buat_slug($article)) ?>
<?php $abstract = potong_teks(strip_tags($article['isi']), 150) ?>
<?php $image = ($article['gambar'] && is_file(LOKASI_FOTO_ARTIKEL.'sedang_'.$article['gambar'])) ?
  AmbilFotoArtikel($article['gambar'],'sedang') :
  gambar_desa($desa['logo']);
?>

<article class="card overflow-hidden p-4 article-wrapper">
  <a href="<?= $url ?>" class="article-thumbnail <?php $image === gambar_desa($desa['logo']) and print('flex items-center') ?>">
    <img loading="lazy" src="<?= $image ?>" alt="logo desa" class="<?php $image !== gambar_desa($desa['logo']) and print('article-image w-full object-cover object-center') ?> mx-auto">
  </a>
  <div class="article-caption space-y-3 pt-3">
    <a href="<?= $url ?>" class="text-heading lg:text-lg text-link block"><?= $article['judul'] ?></a>
    <ul class="flex flex-wrap text-sm space-x-4">
      <li class="inline-flex items-center">
        <span class="ti ti-calendar icon-sm text-secondary mr-2"></span>
        <span><?= tgl_indo($article['tgl_upload']) ?></span>
      </li>
      <li class="inline-flex items-center">
        <span class="ti ti-user icon-sm text-secondary mr-2"></span>
        <span><?= $article['owner'] ?></span>
      </li>
    </ul>
    <p class="hidden lg:block"><?= $abstract ?>... <a href="<?= $url ?>" class="underline text-secondary">Selengkapnya</a></p>
  </div>
</article>