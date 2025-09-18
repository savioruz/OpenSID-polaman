<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php $navs = array(
  array(
    'icon' => 'home',
    'name' => 'Beranda',
    'url' => site_url()
  ),
  array(
    'icon' => 'map-pin',
    'name' => 'Peta',
    'url' => site_url('peta')
  ),
  array(
    'icon' => 'category-2',
    'name' => 'Menu',
    'url' => '#'
  ),
  array(
    'icon' => 'login',
    'name' => 'Login',
    'url' => '#'
  ),
  array(
    'icon' => 'photo-heart',
    'name' => 'Galeri',
    'url' => site_url('galeri')
  )) ?>

<section class="fixed inset-x-0 bottom-0 left-0 max-w-screen right-0 z-40 bg-white dark:bg-dark-secondary shadow-xl lg:hidden lg:invisible bottom-nav">
  <div class="flex justify-between">
    <?php foreach($navs as $nav) : ?>
      <a href="<?= $nav['url'] ?>" class="flex flex-col items-center w-full pt-2 pb-1 active:text-secondary <?php $nav['icon'] == 'category-2' and print('bg-primary text-white') ?>" data-mdb-ripple="true" data-mdb-ripple-color="light" <?php $nav['icon'] == 'category-2' and print('@click="drawer = !drawer"') ?>
        <?php if($nav['icon'] == 'login') : ?>
          data-bs-target="#modal-login" data-bs-toggle="modal" @click="drawer = false"
        <?php endif ?>
      >
        <i class="ti ti-<?= $nav['icon'] ?> text-lg"></i>
        <span class="text-xs"><?= $nav['name'] ?></span>
      </a>
    <?php endforeach ?>
  </div>
</section>
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" role="dialog"
  id="modal-login" tabindex="-1" aria-labelledby="modal-login-label" aria-hidden="true">
  <div class="modal-dialog bg-white rounded relative w-auto">
    <div
      class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
      <div
        class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
        <h5 class="text-xl font-heading font-medium leading-normal text-gray-800" id="exampleModalLabel">Menu Login</h5>
        <button type="button"
          class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
          data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body relative p-4 flex flex-col space-y-3">
      <a href="<?= site_url('layanan-mandiri') ?>" class="button button-primary text-center px-5 py-3 text-sm" data-mdb-ripple="true" data-md-ripple-color="light">Login Layanan Mandiri</a>
      <a href="<?= site_url('siteman') ?>" class="button button-secondary text-center px-5 py-3 text-sm" data-mdb-ripple="true" data-md-ripple-color="light">Login Admin</a>
      <a href="<?= site_url('kehadiran/masuk') ?>" class="button button-tertiary text-center px-5 py-3 text-sm" data-mdb-ripple="true" data-md-ripple-color="light">Login Kehadiran Perangkat</a>
      </div>
    </div>
  </div>
</div>