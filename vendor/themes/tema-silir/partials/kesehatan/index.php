<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="py-4 px-5">
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title">
    <?= $title; ?></h1>

  <form class="grid grid-cols-1 lg:grid-cols-4 gap-3 py-3 w-full" action="" method="get">
    <div class="space-y">
      <select name="kuartal" id="kuartal" required class="form-input inline-block" title="Pilih salah satu">
        <?php foreach (kuartal2() as $item): ?>
        <option value="<?= $item['ke'] ?>" <?= $item['ke'] == $kuartal ? 'selected' : '' ?>>
          Kuartal ke <?= $item['ke'] ?>
          (<?= $item['bulan'] ?>)
        </option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="space-y">
      <select name="tahun" id="tahun" class="form-input inline-block" title="Pilih salah satu">
        <?php foreach ($dataTahun as $item): ?>
        <option value="<?= $item->tahun ?>"><?= $item->tahun ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="space-y">
      <select name="id_posyandu" class="form-input inline-block" title="Pilih salah satu">
        <option value="">Semua</option>
        <?php foreach ($posyandu as $item): ?>
        <option value="<?= $item->id ?>" <?= $item->id == $idPosyandu ? 'selected' : '' ?>>
          <?= $item->nama ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="col-md-2">
      <button type="submit" class="button button-secondary" data-mdb-ripple="true" data-md-ripple-color="light"
        id="cari">
        <i class="ti ti-search"></i> Cari
      </button>
    </div>
  </form>
  <div class="box-body text-sm py-2 space-y-4">
    <?php $this->load->view($folder_themes . '/partials/kesehatan/widget'); ?>
    <?php $this->load->view($folder_themes . '/partials/kesehatan/chart_stunting_umur'); ?>
    <?php $this->load->view($folder_themes . '/partials/kesehatan/chart_stunting_posyandu'); ?>
    <?php $this->load->view($folder_themes . '/partials/kesehatan/scorecard', $scorecard); ?>
  </div>
</div>