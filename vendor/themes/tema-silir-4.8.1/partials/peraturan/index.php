<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title">Produk Hukum</h1>
<form class="grid grid-cols-1 lg:grid-cols-3 gap-3">
  <div class="space-y-2">
    <label for="tahun" class="text-xs lg:text-sm">Tahun</label>
    <select class="form-input inline-block" id="tahun" name="tahun">
      <option selected value="">Semua</option>
      <?php foreach ($pilihan_tahun as $tahun) : ?>
      <option value="<?= $tahun ?>"><?= $tahun ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="space-y-2">
    <label for="kategori" class="text-xs lg:text-sm">Kategori</label>
    <select class="form-input inline-block" id="kategori" name="kategori">
      <option selected value="">Semua</option>
      <?php foreach ($pilihan_kategori as $id => $kategori) : ?>
      <option value="<?= $id ?>"><?= $kategori ?></option>
      <?php endforeach; ?>
    </select>
  </div>
</form>
<div class="py-0.5 content px-0">
  <div class="table-responsive">
    <table class="w-full text-sm" id="tabeldata">
      <thead class="bg-gray disabled color-palette">
        <tr>
          <th>No</th>
          <th>Judul Produk Hukum</th>
          <th>Jenis</th>
          <th>Tahun</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<script>
  $(document).ready(function () {
    var TableData = $('#tabeldata').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: {
        url: "<?= site_url('fweb/peraturan/datatables') ?>",
        data: function (req) {
          req.tahun = $('#tahun').val();
          req.kategori = $('#kategori').val();
        },
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false,
          width: '5%',
        },
        {
          data: 'nama',
          name: 'nama',
          width: '50%',
        },
        {
          data: 'kategori_dokumen',
          name: 'kategori_dokumen',
          width: '10%',
        },
        {
          data: 'tahun',
          name: 'tahun',
          width: '10%',
        },
        {
          data: function (data) {
            if (data.url != null) {
              return `<button onclick="window.location.href='${data.url}'" class="button button-primary block" target="_blank" rel="noopener noreferrer" data-mdb-ripple="true" data-md-ripple-color="light">Lihat</button>`;
            }
            return '<a href="<?= site_url('dokumen_web/unduh_berkas/') ?>' + data.id +
              '" class="button button-primary block" target="_blank" rel="noopener noreferrer" data-mdb-ripple="true" data-md-ripple-color="light">Unduh</a>';
          },
          name: 'aksi',
          searchable: false,
          orderable: false,
          width: '10%',
        },
      ],
      order: [
        [3, 'asc']
      ]
    });

    $('select[name="tahun"]').on('change', function () {
      $(this).val();
      TableData.ajax.reload();
    });

    $('select[name="kategori"]').on('change', function () {
      $(this).val();
      TableData.ajax.reload();
    });
  });
</script>