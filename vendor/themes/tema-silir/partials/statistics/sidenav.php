<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php 
  $daftar_statistik = daftar_statistik();
  $slug_aktif       = str_replace('_', '-', $slug_aktif);
  $s_links_u = [
    [
      'target' => 'statistikPenduduk',
      'label' => 'Statistik Penduduk',
      'icon' => 'ti-chart-pie',
      'submenu' => [
        [
          'slug' => 'first/statistik/13',
          'label' => 'Umur (Rentang)'
        ],
        [
          'slug' => 'first/statistik/15',
          'label' => 'Umur (Kategori)'
        ],
        [
          'slug' => 'first/statistik/0',
          'label' => 'Pendidikan Dalam KK'
        ],
        [
          'slug' => 'first/statistik/14',
          'label' => 'Pendidikan Sedang Ditempuh'
        ],
        [
          'slug' => 'first/statistik/1',
          'label' => 'Pekerjaan'
        ],
        [
          'slug' => 'first/statistik/2',
          'label' => 'Status Perkawinan'
        ],
        [
          'slug' => 'first/statistik/3',
          'label' => 'Agama'
        ],
        [
          'slug' => 'first/statistik/4',
          'label' => 'Jenis Kelamin'
        ],
        [
          'slug' => 'first/statistik/hubungan_kk',
          'label' => 'Hubungan Dalam KK'
        ],
        [
          'slug' => 'first/statistik/5',
          'label' => 'Warga Negara'
        ],
        [
          'slug' => 'first/statistik/6',
          'label' => 'Status Penduduk'
        ],
        [
          'slug' => 'first/statistik/7',
          'label' => 'Golongan Darah'
        ],
        [
          'slug' => 'first/statistik/9',
          'label' => 'Penyandang Cacat'
        ],
        [
          'slug' => 'first/statistik/10',
          'label' => 'Penyakit Menahun'
        ],
        [
          'slug' => 'first/statistik/16',
          'label' => 'Akseptor KB'
        ],
        [
          'slug' => 'first/statistik/17',
          'label' => 'Akta Kelahiran'
        ],
        [
          'slug' => 'first/statistik/18',
          'label' => 'Kepemilikan KTP'
        ],
        [
          'slug' => 'first/statistik/19',
          'label' => 'Asuransi Kesehatan'
        ],
        [
          'slug' => 'first/statistik/covid',
          'label' => 'Status Covid'
        ],
        [
          'slug' => 'first/statistik/suku',
          'label' => 'Suku / Etnis'
        ],
        [
          'slug' => 'first/statistik/bpjs-tenagakerja',
          'label' => 'BPJS Ketenagakerjaan'
        ]
      ]
    ],
    [
      'target' => 'statistikKeluarga',
      'label' => 'Statistik Keluarga',
      'icon' => 'ti-chart-bar',
      'submenu' => [
        [
          'slug' => 'first/statistik/kelas_sosial',
          'label' => 'Kelas Sosial'
        ]
      ]
    ],
    [
      'target' => 'statistikBantuan',
      'label' => 'Statistik Bantuan',
      'icon' => 'ti-chart-line',
      'submenu' => [
        [
          'slug' => 'first/statistik/bantuan_penduduk',
          'label' => 'Penerima Bantuan Penduduk'
        ],
        [
          'slug' => 'first/statistik/bantuan_keluarga',
          'label' => 'Penerima Bantuan Keluarga'
        ],
        [
          'slug' => 'first/statistik/501',
          'label' => 'BPNT'
        ],
        [
          'slug' => 'first/statistik/502',
          'label' => 'BLSM'
        ],
        [
          'slug' => 'first/statistik/503',
          'label' => 'PKH'
        ],
        [
          'slug' => 'first/statistik/504',
          'label' => 'Bedah Rumah'
        ],
        [
          'slug' => 'first/statistik/505',
          'label' => 'JAMKESMAS'
        ]
      ]
    ],
    [
      'target' => 'statistikLainnya',
      'label' => 'Statistik Lainnya',
      'icon' => 'ti-chart-area',
      'submenu' => [
        [
          'slug' => 'first/dpt',
          'label' => 'Calon Pemilih'
        ],
        [
          'slug' => 'data-wilayah',
          'label' => 'Wilayah Administratif'
        ]
      ]
    ]
  ];
  $s_links_p = [
    [
      'target' => 'statistikPenduduk',
      'label' => 'Statistik Penduduk',
      'icon' => 'ti-chart-pie',
      'submenu' => $daftar_statistik['penduduk']
    ],
    [
      'target' => 'statistikKeluarga',
      'label' => 'Statistik Keluarga',
      'icon' => 'ti-chart-bar',
      'submenu' => $daftar_statistik['keluarga']
    ],
    [
      'target' => 'statistikBantuan',
      'label' => 'Statistik Bantuan',
      'icon' => 'ti-chart-line',
      'submenu' => $daftar_statistik['bantuan']
    ],
    [
      'target' => 'statistikLainnya',
      'label' => 'Statistik Lainnya',
      'icon' => 'ti-chart-area',
      'submenu' => $daftar_statistik['lainnya']
    ]
  ];
  $s_links = $s_links_p;
?>

<div class="accordion" id="statistikNavigation">
  <?php foreach($s_links as $statistik) : ?>
    <?php $is_active = in_array($slug_aktif, array_column($statistik['submenu'], 'slug')) ?>
    <div class="accordion-item bg-white dark:bg-dark-secondary border border-gray-200 dark:border-dark-primary">
      <h4 class="accordion-header mb-0" id="heading-<?= $statistik['label'] ?>">
        <button
          class="accordion-button relative flex items-center w-full py-4 px-5 text-base text-left bg-white dark:bg-dark-secondary border-0 rounded-none transition focus:outline-none font-heading font-bold <?php !$is_active and print('collapsed') ?>"
          type="button" data-bs-toggle="collapse" data-bs-target="#<?= $statistik['target']?>" aria-expanded="<?= $is_active ? 'true' : 'false' ?>"
          aria-controls="<?= $statistik['target']?>">
          <i class="ti <?= $statistik['icon'] ?> mr-2"></i> <?= $statistik['label'] ?>
        </button>
      </h4>
      <div id="<?= $statistik['target'] ?>" class="accordion-collapse collapse <?php $is_active && print('show') ?>" data-bs-parent="#statistikNavigation" aria-labelledby="heading-<?= $statistik['target']?>">
        <div class="accordion-body">
          <ul class="divide-y dark:divide-dark-primary">
            <?php foreach($statistik['submenu'] as $submenu) : ?>
              <?php $stat_slug = (in_array($statistik['target'], ['statistikBantuan', 'statistikLainnya']) ? str_replace('first/', '', $submenu['url']) : 'statistik/' . $submenu['key']) ?>
              <?php if($this->web_menu_model->menu_aktif($stat_slug)) : ?>
                <?php $stat_url = $submenu['url'] ?>
                <li><a href="<?= site_url($stat_url) ?>" class="px-5 py-2 block <?= $submenu['slug'] == $slug_aktif ? 'bg-primary text-white' : 'hover:cursor-pointer hover:text-primary dark:text-white' ?>"><?= $submenu['label'] ?></a></li>
              <?php endif ?>
            <?php endforeach ?>
          </ul>
        </div>
      </div>
    </div>
  <?php endforeach ?>
</div>
<style>
  .accordion-button:not(.collapsed) {
    color: var(--primary-color);
  }
  .dark .accordion-button:not(.collapsed) {
    color: #eee;
  }
</style>