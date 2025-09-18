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
      <div class="card content main-content">
        <?php if($list_jawab): ?>
          <?php $this->load->view("$folder_themes/partials/statistics/analisis.php"); ?>
          <?php else : ?>
            <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title">Daftar Agregasi Data Analisis <?= ucwords($this->setting->sebutan_desa) ?></h1>
            <?php if ($list_indikator): ?>
              <?php if (count($master_indikator ?? []) > 1) : ?>
                <form action="<?=site_url('data_analisis'); ?>" method="get">
                  <div class="space-y-1 flex gap-3">
                    <label for="" class="block text-sm">Analisis:</label>
                    <select class="form-input" name="master" onchange="this.form.submit()">
                      <?php foreach ($master_indikator as $master): ?>
                        <option value="<?= $master['id']?>" <?= selected($list_indikator['0']['id_master'], $master['id'])?>><?= "{$master['master']} ({$master['tahun']})"?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </form>
              <?php endif; ?>
              <div class="table-responsive py-3">
                <table>
                  <tr>
                    <td width="200">Pendataan </td>
                    <td width="20"> :</td>
                    <td><?= $list_indikator['0']['master']; ?></td>
                  </tr>
                  <tr>
                    <td>Subjek </td>
                    <td> : </td>
                    <td><?= $list_indikator['0']['subjek']; ?></td>
                  </tr>
                  <tr>
                    <td>Tahun </td>
                    <td> :</td>
                    <td><?= $list_indikator['0']['tahun']; ?></td>
                  </tr>
                </table>
              </div>
              <h4 class="text-heading text-base lg:text-xl title">Indikator</h4>
              <div class="table-responsive">
                <table>
                  <?php foreach ($list_indikator as $data): ?>
                    <tr>
                      <td><?= $data['nomor'].'.'; ?>
                      <td><a href="<?= site_url("jawaban_analisis/$data[id]/$data[subjek_tipe]/$data[id_periode]"); ?>" class="font-bold"><?= $data['indikator']?></a></td>
                    </tr>
                  <?php endforeach; ?>
                </table>
              </div>
            <?php else: ?>
            <p>Data tidak tersedia</p>
          <?php endif; ?>
        <?php endif; ?>
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