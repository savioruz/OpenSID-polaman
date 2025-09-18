<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php $items = [
  [
    'name' => 'Deskripsi Desa',
    'icon' => 'list.png',
    'link' => 'https://sid.kemendesa.go.id/home/deskripsi/',
    'is_external' => true
  ],
  [
    'name' => 'Status SDGs',
    'icon' => 'sdgs.png',
    'link' => 'https://sid.kemendesa.go.id/home/sdgs/',
    'is_external' => true
  ],
  [
    'name' => 'Status IDM',
    'icon' => 'chart-pie.png',
    'link' =>  site_url('status-idm/' . date('Y')),
    'is_external' => false
  ],
  [
    'name' => 'Dana Desa',
    'icon' => 'money-bag.png',
    'link' => 'https://sid.kemendesa.go.id/home/dd/',
    'is_external' => true
  ],
  [
    'name' => 'Rekap APBDesa',
    'icon' => 'financial-profit.png',
    'link' => 'https://sid.kemendesa.go.id/home/apbdes/',
    'is_external' => true
  ]
] ?>

<?php if($kode_desa = $desa['kode_desa']) : ?>
  <section class="grid gap-3 lg:gap-5 grid-cols-3 md:grid-cols-3 lg:grid-cols-5 auto-cols-auto my-5">
    <?php foreach($items as $item) : ?>
      <a href="<?= $item['is_external'] ? ($item['link'] . $kode_desa) : $item['link'] ?>" class="card shadow p-2 lg:p-3 space-y-2 hover:shadow-lg transition duration-200" target="<?= $item['is_external'] ? '_blank' : '_self' ?>">
        <img loading="lazy" src="<?= base_url($this->theme_folder.'/'.$this->theme .'/assets/images/' . $item['icon']) ?>" alt="<?= $item['name'] ?>" class="w-1/2 mx-auto py-2">
        <span class="text-center text-xs lg:text-sm font-bold block"><?= $item['name'] ?></span>
      </a>
    <?php endforeach ?>
  </section>
<?php endif ?>
