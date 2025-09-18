<style type="text/css">
  button.btn {
    margin-left: 0px;
  }

  #collapse2 {
    margin-top: 5px;
  }

  .tabel-info {
    width: 100%;
  }

  .tabel-info, tr {
    border-bottom: 1px;
    border: 0px solid;
  }

  .tabel-info, td {
    border: 0px solid;
    height: 30px;
    padding: 5px;
  }

</style>
<!-- widget Peta Lokasi Kantor Desa -->
<div class="box box-primary box-solid">
  <div class="box-header">
    <h3 class="box-title">
      <i class="ti ti-map-pin mr-1"></i><?='Lokasi Kantor ' . ucwords($this->setting->sebutan_desa)?>
    </h3>
  </div>
  <div class="box-body space-y-3">
    <div id="map_canvas" style="height:200px;"></div>
    <a class="button button-tertiary block w-full text-center" href="https://www.openstreetmap.org/#map=15/<?=$data_config['lat'] . '/' . $data_config['lng']?>" style="color:#fff;" target="_blank" data-mdb-ripple="true" data-md-ripple-color="light">Buka Peta</a>
    <button class="button button-tertiary block w-full z-50 relative btn" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" data-mdb-ripple="true" data-md-ripple-color="light">
      Detail
    </button>
    <div id="collapse2" class="collapse">
      <?php if (is_file(FCPATH . LOKASI_LOGO_DESA . $desa['kantor_desa'])): ?>
        <img loading="lazy" class="img-responsive" src="<?=gambar_desa($desa['kantor_desa'], true)?>" alt="Kantor Desa">
        <hr>
      <?php endif; ?>
      <div class="info-desa">
        <table class="table-info text-sm">
          <tr>
            <td width="25%">Alamat</td>
            <td>:</td>
            <td width="70%"><?=$desa['alamat_kantor']?></td>
          </tr>
          <tr>
            <td width="25%"><?=ucwords($this->setting->sebutan_desa) . ' '?></td>
            <td>:</td>
            <td width="70%"><?=$desa['nama_desa']?></td>
          </tr>
          <tr>
            <td width="25%"><?=ucwords($this->setting->sebutan_kecamatan)?></td>
            <td>:</td>
            <td width="70%"><?=$desa['nama_kecamatan']?></td>
          </tr>
          <tr>
            <td width="25%"><?=ucwords($this->setting->sebutan_kabupaten)?></td>
            <td>:</td>
            <td width="70%"><?=$desa['nama_kabupaten']?></td>
          </tr>
          <tr>
            <td width="25%">Kodepos</td>
            <td>:</td>
            <td width="70%"><?=$desa['kode_pos']?></td>
          </tr>
          <tr>
            <td width="25%">Telepon</td>
            <td>:</td>
            <td width="70%"><?=$desa['telepon']?></td>
          </tr>
          <tr>
            <td width="25%">Email</td>
            <td>:</td>
            <td width="70%"><?=$desa['email_desa']?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  //Jika posisi kantor desa belum ada, maka posisi peta akan menampilkan seluruh Indonesia
  <?php if (! empty($data_config['lat']) && ! empty($data_config['lng'])): ?>
    var posisi = [<?=$data_config['lat'] . ',' . $data_config['lng']?>];
    var zoom = <?=$data_config['zoom'] ?: 10?>;
  <?php else: ?>
    var posisi = [-1.0546279422758742,116.71875000000001];
    var zoom = 10;
  <?php endif; ?>

  var lokasi_kantor = L.map('map_canvas').setView(posisi, zoom);

  //Menampilkan BaseLayers Peta
  var baseLayers = getBaseLayers(lokasi_kantor, '<?=$this->setting->mapbox_key?>');

  L.control.layers(baseLayers, null, {position: 'topright', collapsed: true}).addTo(lokasi_kantor);

  //Jika posisi kantor desa belum ada, maka posisi peta akan menampilkan seluruh Indonesia
  <?php if (! empty($data_config['lat']) && ! empty($data_config['lng'])): ?>
    var kantor_desa = L.marker(posisi).addTo(lokasi_kantor);
  <?php endif; ?>
</script>
