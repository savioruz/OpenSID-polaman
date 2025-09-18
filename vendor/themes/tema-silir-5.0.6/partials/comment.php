<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php if(is_array($komentar) && $single_artikel['boleh_komentar']) : ?>
  <?php
    $comments = array();
    foreach ($komentar as $comment ) {
      if($comment['is_archived'] != 1) array_push($comments, $comment);
    }
    $comments = array_reverse($comments);
    $forms = array(
      'owner' => 'Nama',
      'email' => 'Alamat Email',
      'no_hp' => 'No. HP'
    )
  ?>

  <?php $notif = $this->session->flashdata('notif'); ?>
  
  <hr>
  <?php if(count($comments) > 0) : ?>
    <div class="py-3 divide-y" id="comment">
      <?php foreach($comments as $comment) : ?>
        <div class="flex space-x-3 py-3">
          <img loading="lazy" src="<?= base_url($this->theme_folder.'/'.$this->theme .'/assets/images/user.png') ?>" alt="user" class="w-12 h-12 rounded-full">
          <div class="space-y-1 flex flex-col">
            <span class="font-bold"><?= $comment['owner'] ?></span>
            <span class="inline-flex items-center text-sm text-slate-500 dark:text-slate-300"><i class="icon icon-sm mr-1 inline-block ti ti-calendar"></i> <?= $comment['tgl_upload'] ?></span>
            <span>"<?= $comment['komentar'] ?>"</span>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  <?php endif ?>

  <?php if($single_artikel['boleh_komentar'] == 1) : ?>
    <span class="block text-heading text-lg lg:text-xl comment">Kirim Komentar</span>
    <div class="bg-slate-200 dark:bg-dark-primary py-3 px-5 border-l-4 border-secondary comment">
      <p class="text-sm">Komentar baru terbit setelah disetujui Admin</p>
    </div>
    <form action="<?= site_url('/add_comment/'.$single_artikel['id'])?>" method="POST" class="space-y-3"  id="kolom-komentar">
      <div class="flex flex-col space-y-1">
        <label for="komentar" class="form-label">Komentar <span style="color:red">*</span></label>
        <textarea class="form-textarea" name="komentar" id="komentar" cols="30" rows="4" required><?= $notif['data']['komentar'] ?></textarea>
      </div>
      <div class="grid gap-2 lg:grid-cols-3 grid-cols-1">
        <?php foreach($forms as $name => $label) : ?>
          <div class="flex flex-col space-y-1">
            <label for="<?= $name ?>" class="form-label"><?= $label ?> <?php if($name !== 'email') : ?><span style="color:red">*</span><?php endif ?></label>
            <input type="text" class="form-input" id="<?= $name ?>" name="<?= $name ?>" value="<?= $name === 'owner' && !empty($notif['data']['nama']) ? $notif['data']['nama'] : $notif['data'][$name] ?>" <?php $name !== 'email' and print('required') ?>>
          </div>
        <?php endforeach ?>
      </div>
      <div class="flex flex-col lg:flex-row">
        <div class="w-full lg:w-5/12 overflow-hidden">
          <img loading="lazy" id="captcha" src="<?= site_url('captcha') ?>" alt="CAPTCHA Image" class="w-full lg:w-11/12">
          <button type="button" class="button button-transparent text-sm" onclick="document.getElementById('captcha').src = '<?= site_url("captcha") ?>?' + Math.random()" data-mdb-ripple="true" data-mdb-ripple-color="light">[Ganti Gambar]</button>
        </div>
        <div class="w-full lg:w-7/12">
          <input type="text" class="form-input required" name="captcha_code" maxlength="6" value="<?= $notif['data']['captcha_code']; ?>" placeholder="Isikan sesuai kode captcha">
        </div>
      </div>
      <button type="submit" class="button button-secondary" data-mdb-ripple="true" data-mdb-ripple-color="light">Kirim Komentar <span class="ti ti-send ml-2"></span></button>
    </form>
  <?php endif ?>
  
  <?php $alert = ($notif['status'] == -1) ? 'danger' : 'success'; ?>
  <?php if ($flash_message = $notif['pesan']): ?>
    <div class="alert is-<?= $alert ?>"><?= $flash_message?></div>
  <?php endif; ?>
<?php endif; ?>