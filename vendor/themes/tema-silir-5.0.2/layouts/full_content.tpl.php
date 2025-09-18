<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view($folder_themes . '/commons/meta') ?>
  <?php $this->load->view($folder_themes . '/commons/source_css') ?>
  <link rel="stylesheet" href="<?= asset('css/peta.css'); ?>">
</head>
<body data-theme="<?= THEME_COLOR_SCHEME ?>" x-data="{drawer: false}">

  <?php $this->load->view($folder_themes . '/commons/loading_screen') ?>
  <main class="px-3 mx-auto space-y-5 my-5">
    <div class="group flex gap-5 flex-wrap items-center">
      <a href="<?= site_url() ?>" class="button button-primary inline-flex items-center text-xs"><i class="ti ti-chevron-left mr-1"></i>Kembali ke Beranda</a>
      <h1 class="text-heading text-lg lg:text-2xl title">Peta <?= NAMA_DESA ?></h1>
    </div>
    <?php theme_view($halaman_peta); ?>
  </main>

  <?php $this->load->view($folder_themes . '/commons/source_js') ?>
  <script defer src="<?= base_url("$this->theme_folder/$this->theme/assets/js/script.min.js?" . THEME_VERSION) ?>"></script>
  <script>
    $('.fetched-data').on('DOMNodeInserted', 'link[rel=stylesheet]', function () {
      $(this).remove();
    });
  </script>
</body>
</html>