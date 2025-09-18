<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view($folder_themes .'/commons/meta') ?>
  <?php $this->load->view($folder_themes .'/commons/source_css') ?>
</head>
<body data-theme="<?= THEME_COLOR_SCHEME ?>" x-data="{drawer: false}">
  <?php if($this->uri->segment(2) == 'kategori' && empty($judul_kategori)) : ?>
    <?php $this->load->view($folder_themes .'/commons/404') ?>
    <?php else : ?>
      <?php $this->load->view($folder_themes . '/commons/loading_screen') ?>
      <?php $home_style = theme_config('home_style') ?>
      <?php $this->load->view($folder_themes .'/layouts/'.$home_style.'.tpl.php') ?>
      <?php $this->load->view($folder_themes .'/commons/footer') ?>
      <?php $this->load->view($folder_themes . '/commons/customizer') ?>
  <?php endif ?>
  <?php $this->load->view($folder_themes .'/commons/source_js') ?>
  <script defer src="<?= base_url("$this->theme_folder/$this->theme/assets/js/script.min.js?" . THEME_VERSION) ?>"></script>
</body>
</html>