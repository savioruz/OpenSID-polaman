<!-- Widget Agenda -->

<style type="text/css">
  .nav-tabs .active {
    /* color: var(--primary-color); */
    border: 1px solid #bcbcbc !important;
    border-bottom: 0 !important;
    margin-bottom: -2px;
    background-color: #fff;
    padding: 5px 10px;
    border-radius: 5px 5px 0 0;
  }
  .dark .nav-tabs .active {
    background-color: rgb(45 55 72 / var(--tw-bg-opacity));
    color: white;
  }
</style>

<div class="box box-primary box-solid">
  <div class="box-header">
    <h3 class="box-title"><i class="ti ti-calendar mr-1"></i> Agenda</a></h3>
  </div>
  <div id="agenda" class="box-body">
    <ul class="nav nav-tabs flex list-none !border-b !mb-0">
      <?php if (count($hari_ini) > 0): ?>
        <li class="nav-item !pb-0 flex-grow text-center" style="max-width:50%" role="presentation"><a class="nav-link w-full block font-medium active" data-bs-toggle="tab" href="#hari-ini">Hari ini</a></li>
      <?php endif; ?>
      <?php if (count($yad) > 0): ?>
        <li class="nav-item !pb-0 flex-grow text-center" style="max-width:50%" role="presentation"><a data-bs-toggle="tab" href="#yad" class="nav-link w-full block font-medium <?php count($hari_ini) == 0 && print 'active'?>">Yang akan datang</a></li>
      <?php endif; ?>
      <?php if (count($lama) > 0): ?>
        <li class="nav-item !pb-0 flex-grow text-center" style="max-width:50%" role="presentation"><a class="nav-link w-full block font-medium <?php count(array_merge($hari_ini, $yad)) == 0 && print 'active'?>" data-bs-toggle="tab" href="#lama">Lama</a></li>
      <?php endif; ?>
    </ul>

    <div class="tab-content" style="max-height: 250px; overflow: auto">
      <?php if (count(array_merge($hari_ini, $yad, $lama)) > 0): ?>
        <div id="hari-ini" class="tab-pane fade <?php count($hari_ini) > 0 and print('in show active') ?>">
          <div class="sidebar-latest text-sm space-y-2">
            <?php foreach ($hari_ini as $agenda): ?>
              <table id="table-agenda" class="border-b" width="100%">
                <tr>
                  <td colspan="3"><a href="<?= site_url('artikel/' . buat_slug($agenda))?>"><i class="ti ti-checklist mr-1"></i><?= $agenda['judul']?></a></td>
                </tr>
                <tr>
                  <th id="label-meta-agenda" width="40%">Waktu</th>
                  <td width="5%">:</td>
                  <td id="isi-meta-agenda" width="55%"><?= tgl_indo2($agenda['tgl_agenda'])?></td>
                </tr>
                <tr>
                  <th id="label-meta-agenda">Lokasi</th>
                  <td>:</td>
                  <td id="isi-meta-agenda"><?= $agenda['lokasi_kegiatan']?></td>
                </tr>
                <tr>
                  <th id="label-meta-agenda">Koordinator</th>
                  <td>:</td>
                  <td id="isi-meta-agenda"><?= $agenda['koordinator_kegiatan']?></td>
                </tr>
              </table>
            <?php endforeach; ?>
          </div>
        </div>

        <div id="yad" class="tab-pane fade <?php (count($hari_ini) == 0 && count($yad) > 0)  && print 'in show active'?>">
          <div class="sidebar-latest text-sm space-y-2">
            <?php if (count($yad) > 0): ?>
              <?php foreach ($yad as $agenda): ?>
                <table id="table-agenda" class="border-b" width="100%">
                  <tr>
                    <td colspan="3"><a href="<?= site_url('artikel/' . buat_slug($agenda))?>"><i class="ti ti-checklist mr-1"></i><?= $agenda['judul']?></a></td>
                  </tr>
                  <tr>
                    <th id="label-meta-agenda" width="40%">Waktu</th>
                    <td width="5%">:</td>
                    <td id="isi-meta-agenda" width="55%"><?= tgl_indo2($agenda['tgl_agenda'])?></td>
                  </tr>
                  <tr>
                    <th id="label-meta-agenda">Lokasi</th>
                    <td>:</td>
                    <td id="isi-meta-agenda"><?= $agenda['lokasi_kegiatan']?></td>
                  </tr>
                  <tr>
                    <th id="label-meta-agenda">Koordinator</th>
                    <td>:</td>
                    <td id="isi-meta-agenda"><?= $agenda['koordinator_kegiatan']?></td>
                  </tr>
                </table>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>

        <div id="lama" class="tab-pane fade <?php (count(array_merge($hari_ini, $yad)) == 0 && count($lama) > 0) && print 'in show active'?>">
          <div width="100%" height="100" align="center">
            <div class="sidebar-latest text-sm space-y-2">
              <?php foreach ($lama as $agenda): ?>
                <table id="table-agenda" class="border-b" width="100%">
                  <tr>
                    <td colspan="3"><a href="<?= site_url('artikel/' . buat_slug($agenda))?>"><i class="ti ti-checklist mr-1"></i><?= $agenda['judul']?></a></td>
                  </tr>
                  <tr>
                    <th id="label-meta-agenda" width="40%">Waktu</th>
                    <td width="5%">:</td>
                    <td id="isi-meta-agenda" width="55%"><?= tgl_indo2($agenda['tgl_agenda'])?></td>
                  </tr>
                  <tr>
                    <th id="label-meta-agenda">Lokasi</th>
                    <td>:</td>
                    <td id="isi-meta-agenda"><?= $agenda['lokasi_kegiatan']?></td>
                  </tr>
                  <tr>
                    <th id="label-meta-agenda">Koordinator</th>
                    <td>:</td>
                    <td id="isi-meta-agenda"><?= $agenda['koordinator_kegiatan']?></td>
                  </tr>
                </table>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php else: ?>
        <p>Belum ada agenda</p>
      <?php endif; ?>
    </div>
  </div>
</div>
