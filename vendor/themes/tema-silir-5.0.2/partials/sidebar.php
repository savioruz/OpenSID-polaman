<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<aside class="sidebar">

  <?php $this->load->view($folder_themes .'/widgets/layanan_mandiri') ?>

  <?php foreach($w_cos as $widget) : ?>
    <?php if ($widget["jenis_widget"] == 1): ?>
      <?php if($widget['isi'] == 'layanan_mandiri.php' or $widget['isi'] == 'keuangan.php') : ?>
        <?php continue; ?>
      <?php endif ?>
      <div class="sidebar-item">
        <?php $this->load->view("{$folder_themes}/widgets/{$widget['isi']}"); ?>
      </div>
      <?php elseif($widget['jenis_widget'] == 2) : ?>
        <div class="sidebar-item">
          <h3 class="sidebar-heading"><?= strip_tags($widget['judul']) ?></h3>
          <div class="sidebar-body">
            <?php include($widget['isi']) ?>
          </div>
        </div>
      <?php else : ?>
        <div class="sidebar-item">
          <h3 class="sidebar-heading"><?= strip_tags($widget['judul']) ?></h3>
          <div class="sidebar-body">
            <?= htmlspecialchars_decode(html_entity_decode($widget['isi']), ENT_QUOTES) ?>
          </div>
        </div>
    <?php endif ?>
  <?php endforeach ?>
</aside>