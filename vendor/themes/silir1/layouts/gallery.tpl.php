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
    <?php $this->load->view($folder_themes . '/partials/newsticker') ?>

    <section class="content-wrapper my-5">
      <div class="card content">
        <?php $this->load->view($folder_themes . '/partials/gallery'); ?>
        <?php $data['paging_page'] = ($paging_page ?? 'first/gallery') ?>
        <?php $this->load->view($folder_themes .'/commons/paging', $data) ?>
      </div>
      <?php $this->load->view($folder_themes .'/partials/sidebar') ?>
    </section>
    <?php $this->load->view($folder_themes .'/widgets/shortcut_links') ?>
  </main>

  <?php $this->load->view($folder_themes .'/commons/footer') ?>
  <?php $this->load->view($folder_themes . '/commons/customizer') ?>

  <?php $this->load->view($folder_themes . '/commons/source_js') ?>
  <script defer src="<?= base_url("$this->theme_folder/$this->theme/assets/js/script.min.js?" . THEME_VERSION) ?>"></script>

</body>
</html>