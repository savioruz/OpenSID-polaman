<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view($folder_themes . '/commons/meta') ?>
  <?php $this->load->view($folder_themes . '/commons/source_css') ?>
</head>
<body data-theme="<?= THEME_COLOR_SCHEME ?>" x-data="{drawer: false}">

  <?php $this->load->view($folder_themes . '/commons/loading_screen') ?>
  <?php $this->load->view($folder_themes . '/commons/header') ?>
  <?php $this->load->view($folder_themes . '/commons/main_nav') ?>

  <main class="container px-3 max-w-container mx-auto space-y-5 my-5">
    <?php $this->load->view($folder_themes . '/partials/map') ?>
  </main>

  <?php $this->load->view($folder_themes .'/commons/footer') ?>
  <?php $this->load->view($folder_themes . '/commons/customizer') ?>

  <?php $this->load->view($folder_themes . '/commons/source_js') ?>
  <script defer src="<?= base_url("$this->theme_folder/$this->theme/assets/js/script.min.js?" . THEME_VERSION) ?>"></script>
  <script>
    $('.fetched-data').on('DOMNodeInserted', 'link[rel=stylesheet]', function () {
      $(this).remove();
    });
  </script>
</body>
</html>