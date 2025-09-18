<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<style type="text/css">
  .label {
    border-radius: 4px;
    padding: 2px 8px;
    color: white;
  }
  .label-danger {
    background-color: #dc2626;
  }
  .label-info {
    background-color: #0891b2;
  }
  .label-success {
    background-color: #059669;
  }

  .support-content .fa-padding .fa {
    padding-top: 5px;
    width: 1.5em;
  }

  .support-content .info {
    color: #777;
    margin: 0px;
  }

  .support-content a {
    color: #111;
  }

  .support-content .info a:hover {
    text-decoration: underline;
  }

  .support-content .info .fa {
    width: 1.5em;
    text-align: center;
  }

  .support-content .number {
    color: #777;
  }

  .support-content img {
    margin: 0 auto;
    display: block;
  }

  .support-content .modal-body {
    padding-bottom: 0px;
  }

  .support-content-comment {
    padding: 10px 10px 10px 30px;
  }

  .italic {
    font-style:italic;
  }

  .items-end {
    align-items: flex-end;
  }
</style>

<div class="py-4 px-5">
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i class="ti ti-mail inline-block mr-1"></i> Pengaduan</h1>
  <div class="bg-slate-200 dark:bg-dark-primary py-3 px-5 border-l-4 border-secondary my-5 space-y-3">
    <p class="text-sm text-justify">Layanan Pengaduan bagi warga <?= ucwords($this->setting->sebutan_desa) .' '. ucwords($desa['nama_desa']) ?>,
            <?= ucwords($this->setting->sebutan_kecamatan) .' '. ucwords($desa['nama_kecamatan']) ?>,
            <?= ucwords($this->setting->sebutan_kabupaten) .' '. ucwords($desa['nama_kabupaten']) ?> yang ingin menyampaikan keluhan dan laporan terkait penyelenggaraan pemerintahan <?= $this->setting->sebutan_desa ?> dan pelaksanaan pembangunan.</p>
  </div>
  <form action="<?= $search_action; ?>" method="get">
    <div class="flex gap-3 lg:w-7/12 flex-col lg:flex-row py-2">
      <button type="button" class="button button-primary flex-shrink-0" data-bs-toggle="modal" data-bs-target="#newpengaduan" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-square-rounded-plus text-lg mr-1 inline-block"></i> Ajukan Pengaduan</button>
      <select class="form-input inline-block select2" id="caristatus" name="caristatus">
        <option value="">Semua Status</option>
        <option value="1" <?= selected($caristatus, 1); ?>>Menunggu Diproses</option>
        <option value="2" <?= selected($caristatus, 2); ?>>Sedang Diproses</option>
        <option value="3" <?= selected($caristatus, 3); ?>>Selesai Diproses</option>
      </select>
      <input type="text" name="cari" value="<?= $cari; ?>" placeholder="Cari pengaduan disini..." class="form-input inline-block">
      <button type="submit" class="button button-secondary" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-search"></i></button>
      <?php if ($cari) : ?>
        <a href="<?= site_url('pengaduan'); ?>" class="button button-tertiary" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-times"></i></a>
      <?php endif; ?>
    </div>
  </form>
  
  
  <?php if (($notif = $this->session->flashdata('notif')) && (! $this->session->flashdata('notif')['data'])) : ?>
  <div class="alert is-<?= $notif['status']; ?>" role="alert">
    <?= $notif['pesan']; ?>
  </div>
  <?php endif; ?>
  <?php if($pengaduan) : ?>
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-5 py-2">
      <?php foreach($pengaduan as $key => $value) : ?>
        <div class="card p-5 border cursor-pointer" data-bs-toggle="modal" data-bs-target="#pengaduan<?= $value['id'] ?>">
          <dl>
            <dt class="font-bold lg:text-xl"><?= $value['judul']; ?></dt>
            <ul class="inline-flex flex-wrap gap-2 w-full items-center text-xs">
              <li class="inline-flex items-center"><i class="ti ti-calendar inline-block mr-1 text-secondary"></i> <?= $value['created_at'] ?></li>
              <li class="inline-flex items-center"><i class="ti ti-user inline-block mr-1 text-secondary"></i> <?= $value['nama'] ?></li>
              <li>
                <?php if ($value['status'] == '1') : ?>
                  <span class="label label-danger">Menunggu Diproses</span>
                <?php elseif ($value['status'] == '2') : ?>
                  <span class="label label-info">Sedang Diproses</span>
                <?php elseif ($value['status'] == '3') : ?>
                  <span class="label label-success">Selesai Diproses</span>
                <?php endif; ?>
              </li>
            </ul>
            <dd class="pt-2 flex flex-col lg:flex-row items-end justify-between gap-3">
              <span class="italic"><?= substr($value['isi'], 0, 50); ?> <?php if (strlen($value['isi']) > 50) : ?>... <label class="underline">selengkapnya ></label><?php endif; ?></span>
              <span class="label label-<?= $value['jumlah'] > 0 ? 'success' : 'info'; ?> pull-right text-xs flex-shrink-0"><i class="ti ti-messages"></i> <?= $value['jumlah']; ?> Tanggapan</span>
            </dd>
          </dl>
        </div>
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="pengaduan<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="pengaduan<?= $value['id'] ?>" aria-hidden="true">
          <div class="modal-dialog relative w-auto">
            <div class="modal-content rounded-lg" style="border:none">
              <div class="modal-header border-b px-4 py-3 flex items-center justify-between text-left text-slate-800">
                <h4 class="modal-title inline-flex items-center gap-3"><i class="ti ti-folder"></i> <?= $value['judul'] ?></h4>
              </div>
              <div class="modal-body px-4 py-3">
                <div class="w-full py-2 space-y-2">
                  <p class="text-sm">Pengaduan oleh <?= $value['nama']; ?> | <?= $value['created_at'] ?></p>
                  <p class="italic">"<?= $value['isi'] ?></p>
                  <?php if ($value['foto']) : ?>
                    <img loading="lazy" class="w-full" src="<?= base_url(LOKASI_PENGADUAN . $value['foto']); ?>">
                  <?php endif; ?>
                </div>
                <?php foreach ($pengaduan_balas as $keyna => $valuena) : ?>
                  <?php if ($valuena['id_pengaduan'] && $valuena['id_pengaduan'] == $value['id']) : ?>
                    <div class="bg-slate-200 dark:bg-dark-primary py-2 px-4 border-l-4 border-secondary my-2">
                      <p class="text-sm">Ditanggapi oleh <?= $valuena['nama']; ?> | <?= $valuena['created_at'] ?></p>
                      <p class="italic">"<?= $valuena['isi'] ?></p>
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
              <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                <button type="button" class="button button-tertiary" data-bs-dismiss="modal" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-times"></i> Tutup</button>
              </div>
            </div>
          </div>
        </div>
        <!-- END DETAIL TICKET -->
      <?php endforeach ?>
    </section>
    <?php $this->load->view($folder_themes .'/commons/paging') ?>
    <?php else : ?>
      <div class="alert is-info" role="alert">
        Data tidak tersedia
      </div>
  <?php endif ?>
  <!-- Formulir Pengaduan -->
  <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="newpengaduan" tabindex="-1" role="dialog" aria-labelledby="newpengaduan" aria-hidden="true">
    <div class="modal-dialog relative w-auto">
      <div class="modal-content rounded-lg" style="border:none">
        <div class="modal-header border-b dark:border-slate-800 px-4 py-3 flex items-center justify-between text-left text-slate-800">
          <h4 class="modal-title inline-flex items-center gap-3 font-heading font-bold dark:text-white"><i class="ti ti-pencil fa-2x"></i> Buat Pengaduan Baru</h4>
        </div>
        <form action="<?= $form_action; ?>" method="POST" enctype="multipart/form-data">
          <div class="modal-body px-4 py-3">
            <?php if (($notif = $this->session->flashdata('notif')) && ($data = $this->session->flashdata('notif')['data'])) : ?>
              <div class="alert is-danger" role="alert">
                <?= $notif['pesan']; ?>
              </div>
            <?php endif; ?>
            <div class="py-2">
              <input name="nik" type="text" maxlength="16" class="form-input" placeholder="NIK" value="<?= $data['nik']; ?>">
            </div>
            <div class="py-2">
              <input name="nama" type="text" class="form-input" placeholder="Nama*" value="<?= $data['nama']; ?>" required>
            </div>
            <div class="py-2">
              <input name="email" type="email" class="form-input" placeholder="Email" value="<?= $data['email']; ?>">
            </div>
            <div class="py-2">
              <input name="telepon" type="text" class="form-input" placeholder="Telepon" value="<?= $data['telepon']; ?>">
            </div>
            <div class="py-2">
              <input name="judul" type="text" class="form-input" placeholder="Judul*" value="<?= $data['judul']; ?>" required>
            </div>
            <div class="py-2">
              <textarea name="isi" class="form-textarea" placeholder="Isi Pengaduan*" rows="5" required><?= $data['isi']; ?></textarea>
            </div>
            <div class="py-2">
              <div class="relative">
                <input type="text" accept="image/*" onchange="readURL(this);" class="form-input" id="file_path" placeholder="Unggah Foto" name="foto" value="<?= $data['foto']; ?>">
                <input type="file" accept="image/*" onchange="readURL(this);" class="hidden" id="file" name="foto" value="<?= $data['foto']; ?>">
                <span class="absolute top-1/2 right-0 transform -translate-y-1/2 mr-1">
                  <button type="button" class="button button-info button-flat" id="file_browser" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-search"></i></button>
                </span>
              </div>
              <small>Gambar: png,jpg,jpeg</small><br>
              <br><img loading="lazy" id="blah" src="#" alt="gambar pendukung di sini" class="max-w-full w-full hidden" />
            </div>
            <div class="flex">
              <div class="w-full lg:w-5/12 overflow-hidden">
                <img loading="lazy" id="captcha" src="<?= site_url('captcha') ?>" alt="CAPTCHA Image" class="w-full lg:w-11/12">
                <button type="button" class="button button-transparent text-sm" data-mdb-ripple="true" data-md-ripple-color="light" onclick="document.getElementById('captcha').src = '<?= site_url("captcha") ?>'">[Ganti Gambar]</button>
              </div>
              <div class="w-full lg:w-7/12">
                <input type="text" class="form-input required" name="captcha_code" maxlength="6" value="<?= $notif['data']['captcha_code']; ?>" placeholder="Isikan sesuai kode captcha" required>
              </div>
            </div>
          </div>
          <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-between p-4 border-t border-gray-200 dark:border-slate-800 rounded-b-md">
            <button type="button" class="button button-tertiary pull-left" data-bs-dismiss="modal" aria-hidden="true" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-times"></i> Tutup</button>
            <button type="submit" class="button button-secondary pull-right" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-pencil"></i> Kirim</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>		


<script type="text/javascript">
  $('#file_browser').click(function(e)
  {
    e.preventDefault();
    $('#file').click();
  });
  $('#file').change(function()
  {
    $('#file_path').val($(this).val());
    if ($(this).val() == '')
    {
      $('#'+$(this).data('submit')).attr('disabled','disabled');
    }
    else
    {
      $('#'+$(this).data('submit')).removeAttr('disabled');
    }
  });
  $('#file_path').click(function()
  {
    $('#file_browser').click();
  });
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#blah').removeClass('hidden');
        $('#blah').attr('src', e.target.result).width(150).height(auto);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>