<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<script type="text/javascript">

$(document).ready(function () {
  Highcharts.chart('container', {
    chart: {
      type: 'pie',
      options3d: {
        enabled: true,
        alpha: 45
      }
    },
    title: {
      text: 'Indeks Desa Membangun (IDM)'
    },
    subtitle: {
      text: 'SKOR : IKS, IKE, IKL'
    },

    plotOptions: {
      series: {
        colorByPoint: true
      },
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        showInLegend: true,
        depth: 45,
        innerSize: 70,
        dataLabels: {
          enabled: true,
          format: '<b>{point.name}</b>: {point.y:,.2f} / {point.percentage:.1f} %'
        }
      }
    },
    series: [{
      name: 'SKOR',
      shadow: 1,
      border: 1,
      data: [
        ['IKS', <?= $idm->ROW[35]->SKOR ?>],
        ['IKE', <?= $idm->ROW[48]->SKOR ?>],
        ['IKL', <?= $idm->ROW[52]->SKOR ?>]
      ]
    }]
});


});
</script>
<div class="content">
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i class=" ti ti-chart-pie inline-block mr-1"></i> Status IDM</h1>
  <div class="bg-slate-200 dark:bg-dark-primary py-3 px-5 border-l-4 border-secondary my-5 space-y-3">
    <p class="text-sm text-justify">Indeks Desa Membangun (IDM) merupakan indeks komposit yang dibentuk dari tiga indeks, yaitu Indeks Ketahanan Sosial, Indeks Ketahanan Ekonomi, dan Indeks Ketahanan Ekologi/Lingkungan. Nilai IDM yang semakin tinggi menunjukkan kondisi desa yang semakin baik dari segi sosial, ekonomi, dan ekologi. IDM dapat menentukan status desa berdasarkan nilai dari indeks-indeks tersebut.</p>
  </div>
  <?php if ($idm->error_msg): ?>
  <div class="bg-red-500 text-white px-3 py-5">
    <?= $idm->error_msg ?>
  </div>
  <?php endif ?>
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-5 max-w-full">
    <div class="rounded overflow-hidden bg-blue-500 relative text-white py-5 px-3 lg:px-4">
      <div class="flex flex-col">
        <span class="text-lg lg:text-xl font-bold"><?= number_format($idm->SUMMARIES->SKOR_SAAT_INI, 4) ?></span>
        <span class="text-sm">SKOR IDM SAAT INI</span>
      </div>
      <div class="icon absolute right-0 mr-5 text-5xl text-slate-500 text-opacity-30 top-1/2 transform -translate-y-1/2">
        <i class="ion ion-arrow-graph-up-right"></i>
      </div>
    </div>
    <div class="rounded overflow-hidden bg-yellow-500 relative text-white py-5 px-3 lg:px-4">
      <div class="flex flex-col">
        <span class="text-lg lg:text-xl font-bold"><?= $idm->SUMMARIES->STATUS ?></span>
        <span class="text-sm">STATUS IDM</span>
      </div>
      <div class="icon absolute right-0 mr-5 text-5xl text-slate-500 text-opacity-30 top-1/2 transform -translate-y-1/2">
        <i class="ion ion-ios-pulse-strong"></i>
      </div>
    </div>
    <div class="rounded overflow-hidden bg-emerald-500 relative text-white py-5 px-3 lg:px-4">
      <div class="flex flex-col">
        <span class="text-lg lg:text-xl font-bold"><?= $idm->SUMMARIES->TARGET_STATUS ?></span>
        <span class="text-sm">TARGET STATUS</span>
      </div>
      <div class="icon absolute right-0 mr-5 text-5xl text-slate-500 text-opacity-30 top-1/2 transform -translate-y-1/2">
        <i class="ion ion-stats-bars"></i>
      </div>
    </div>
    <div class="rounded overflow-hidden bg-red-500 relative text-white py-5 px-3 lg:px-4">
      <div class="flex flex-col">
        <span class="text-lg lg:text-xl font-bold"><?= number_format($idm->SUMMARIES->SKOR_MINIMAL, 4) ?></span>
        <span class="text-sm">SKOR MINIMAL</span>
      </div>
      <div class="icon absolute right-0 mr-5 text-5xl text-slate-500 text-opacity-30 top-1/2 transform -translate-y-1/2">
        <i class="ion ion-ios-pie"></i>
      </div>
    </div>
  </div>

  <div class="flex flex-col lg:flex-row pt-2 justify-between">
    <div class="table-responsive">
      <table class="overflow-auto table-striped table text-sm capitalize">
        <tbody>
          <tr>
            <th class="horizontal">PROVINSI</th>
            <td> : <?= $idm->IDENTITAS[0]->nama_provinsi ?></td>
          </tr>
          <tr>
            <th class="horizontal">KABUPATEN</th>
            <td nowrap> : <?= $idm->IDENTITAS[0]->nama_kab_kota ?></td>
          </tr>
          <tr>
            <th class="horizontal"><?= strtoupper($this->setting->sebutan_kecamatan) ?></th>
            <td> : <?= $idm->IDENTITAS[0]->nama_kecamatan ?></td>
          </tr>
          <tr>
            <th class="horizontal"><?= strtoupper($this->setting->sebutan_desa) ?></th>
            <td> : <?= $idm->IDENTITAS[0]->nama_desa ?></td>
          </tr>

      </table>
    </div>
    <figure class="highcharts-figure">
      <div id="container"></div>
    </figure>
  </div>

  <div class="table-responsive text-xs">
    <table class="table table-bordered table-striped dataTable table-hover">
      <thead class="bg-slate color-palette">
        <tr>
          <th rowspan="2" class="padat">NO</th>
          <th rowspan="2">INDIKATOR IDM</th>
          <th rowspan="2">SKOR</th>
          <th rowspan="2">KETERANGAN</th>
          <th rowspan="2" nowrap>KEGIATAN YANG DAPAT DILAKUKAN</th>
          <th rowspan="2">+NILAI</th>
          <th colspan="6" class="text-center">YANG DAPAT MELAKSANAKAN KEGIATAN</th>
        </tr>
        <tr>
          <th>PUSAT</th>
          <th>PROVINSI</th>
          <th>KABUPATEN</th>
          <th>DESA</th>
          <th>CSR</th>
          <th>LAINNYA</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($idm->ROW as $data): ?>
          <tr class="<?php empty($data->NO) && print 'judul'; ?> ">
            <td class="text-center"><?= $data->NO ?></td>
            <td style="min-width: 150px;"><?= $data->INDIKATOR ?></td>
            <td class="padat"><?= $data->SKOR ?></td>
            <td style="min-width: 250px;"><?= $data->KETERANGAN ?></td>
            <td><?= $data->KEGIATAN ?></td>
            <td class="padat"><?= $data->NILAI ?></td>
            <td><?= $data->PUSAT ?></td>
            <td><?= $data->PROV ?></td>
            <td><?= $data->KAB ?></td>
            <td><?= $data->DESA ?></td>
            <td><?= $data->CSR ?></td>
            <td><?= $data->LAINNYA ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>