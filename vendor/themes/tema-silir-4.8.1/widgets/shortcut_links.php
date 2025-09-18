<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php 
  $shortcuts = array(
    array(
      'icon' => 'map.png',
      'name' => 'Peta ' . ucwords($this->setting->sebutan_desa),
      'link' => site_url('peta'),
      'is_external' => false
    ),
    array(
      'icon' => 'compliant.png',
      'name' => 'Produk Hukum',
      'link' => site_url('peraturan-desa'),
      'is_external' => false
    ),
    array(
      'icon' => 'document.png',
      'name' => 'Informasi Publik',
      'link' => site_url('informasi_publik'),
      'is_external' => false
    ),
    array(
      'icon' => 'trolley.png',
      'name' => 'Lapak',
      'link' => site_url('lapak'),
      'is_external' => false
    ),
    array(
      'icon' => 'archive.png',
      'name' => 'Arsip Berita',
      'link' => site_url('arsip'),
      'is_external' => false
    ),
    array(
      'icon' => 'image-gallery.png',
      'name' => 'Album Galeri',
      'link' => site_url('galeri'),
      'is_external' => false
    ),
    array(
      'icon' => 'announcement.png',
      'name' => 'Pengaduan',
      'link' => site_url('pengaduan'),
      'is_external' => false
    ),
    array(
      'icon' => 'architect.png',
      'name' => 'Pembangunan',
      'link' => site_url('pembangunan'),
      'is_external' => false
    ),
    array(
      'icon' => 'pie-chart.png',
      'name' => 'Status IDM',
      'link' => site_url('status-idm/' . (date('Y') - 1)),
      'is_external' => false
    ),
    );
?>

<section class="grid gap-4 lg:gap-5 grid-cols-3 md:grid-cols-3 lg:grid-cols-9 my-5" id="shortcut-link">
  <?php foreach($shortcuts as $index => $shortcut) : ?>
    <a href="<?= $shortcut['link'] ?>" target="<?php $shortcut['is_external'] and print('_blank') ?>" rel="noopener" class="card shadow-lg px-3 py-2 lg:p-3 space-y-2 group shortcut-card dark:border dark:border-gray-500" data-aos="zoom-in" data-aos-delay="<?= $index * 50 ?>">
      <img loading="lazy" src="<?= base_url($this->theme_folder.'/'.$this->theme .'/assets/images/' . $shortcut['icon']) ?>" alt="<?= $shortcut['name'] ?>" class="w-auto mx-auto py-2 h-12 group-hover:scale-125 transition duration-200">
      <span class="text-center text-xs block break-words"><?= $shortcut['name'] ?></span>
    </a>
  <?php endforeach ?>
</section>