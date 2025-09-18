<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<div class="py-4 px-5">
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title">
    <i class="ti ti-recycle text-xl inline-block mr-2"></i>SDGs <?= NAMA_DESA ?>
  </h1>
  <div class="bg-slate-200 dark:bg-dark-primary py-3 px-5 border-l-4 border-secondary my-5 space-y-3">
    <p class="text-sm text-justify">SDGs desa adalah upaya terpadu untuk pembangunan ekonomi, sosial, lingkungan, hukum dan tata kelola masyarakat di tingkat Desa. Goals SDGs Desa diturunkan dari Goals SDGs Nasional menjadi 18 bidang fokus pembangunan. Skala skor SDGs Desa adalah 0 - 100. Semakin besar skor menunjukkan semakin tercapainya goals SDGs Desa. Selengkapnya dapat mengunjungi laman
      <a href="https://sid.kemendesa.go.id/sdgs" target="_blank" class="font-extrabold text-secondary dark:text-white">SDGs Kemendesa.</a></p>
  </div>

  <?php $evaluasi = sdgs() ?>
  <?php if ($error_msg = $evaluasi->error_msg) : ?>
    <div class="alert alert-danger">
      <p class="py-3"><?= $error_msg ?></p>
    </div>
  <?php else : ?>

    <div class="relative border-b-4 mt-5 mb-5">
      <h2 class="pt-5 pb-3 px-3 text-center">
        <span class="text-heading text-5xl"><?= $evaluasi->average ?></span></br>
        <span class="lg:text-lg text-base">Skor SDGs <?= NAMA_DESA ?></span></br>
        <span class="text-xs bg-secondary px-5 justify-center rounded-lg" style="height:4px;"></span>
      </h2>
    </div>

    <div <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">
      <?php foreach ($evaluasi->data as $key => $value) : ?>
        <div class="p-3 rounded-lg shadow border-gray bg-white dark:bg-dark-secondary">
          <img src="<?= asset("images/sdgs/{$value->image}") ?>" alt="<?= $value->images ?>" class="object-cover object-center">
          <div class="text-sm justify-center items-center text-center px-3 pt-3">
            <p class="text-heading text-2xl block"><?= $value->score ?></p>
            <p class="lg:text-lg text-base capitalize">Skor Nilai</p>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  <?php endif ?>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#total').prepend('<?= $hasil ?>')
  });
</script>