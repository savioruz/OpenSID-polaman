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
      <div class="card w-full rounded overflow-hidden">
        <?php if(preg_match("/halaman_statis/i", $halaman_statis)) : ?>
          <?php $this->load->view($halaman_statis); ?>
          <?php else : ?>
            <?php if($halaman_statis === 'idm/index') : ?>
              <div class="main-content">
                <?php $this->load->view("{$folder_themes}/partials/{$halaman_statis}"); ?>
              </div>
              <?php else : ?>
                <?php $halaman_statis = $halaman_statis === "{$folder_themes}/partials/kemendes_sdgs.php" ? 'sdgs/index' : $halaman_statis ?>
                <?php $this->load->view("{$folder_themes}/partials/{$halaman_statis}"); ?>
          <?php endif ?>
        <?php endif ?>
      </div>
    </section>
    <?php $this->load->view($folder_themes .'/widgets/shortcut_links') ?>
  </main>

  <?php $this->load->view($folder_themes .'/commons/footer') ?>
  <?php $this->load->view($folder_themes . '/commons/customizer') ?>

  <?php $this->load->view($folder_themes . '/commons/source_js') ?>
  <script defer src="<?= base_url("$this->theme_folder/$this->theme/assets/js/script.min.js?" . THEME_VERSION) ?>"></script>

</body>
</html>