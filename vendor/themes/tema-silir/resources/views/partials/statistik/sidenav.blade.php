@php defined('BASEPATH') OR exit('No direct script access allowed'); @endphp

@php 
  $daftar_statistik = daftar_statistik();
  $slug_aktif       = str_replace('_', '-', $slug_aktif);
  $s_links = [
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
@endphp


<div class="accordion" id="statistikNavigation">
  @foreach($s_links as $statistik) 
    @php $is_active = in_array($slug_aktif, array_column($statistik['submenu'], 'slug')) @endphp
    <div class="accordion-item bg-white dark:bg-dark-secondary border border-gray-200 dark:border-dark-primary">
      <h4 class="accordion-header mb-0" id="heading-{{ $statistik['label'] }}">
        <button
          class="accordion-button relative flex items-center w-full py-4 px-5 text-base text-left bg-white dark:bg-dark-secondary border-0 rounded-none transition focus:outline-none font-heading font-bold @php !$is_active and print('collapsed') @endphp"
          type="button" data-bs-toggle="collapse" data-bs-target="#{{ $statistik['target']}}" aria-expanded="{{ $is_active ? 'true' : 'false' }}"
          aria-controls="{{ $statistik['target']}}">
          <i class="ti {{ $statistik['icon'] }} mr-2"></i> {{ $statistik['label'] }}
        </button>
      </h4>
      <div id="{{ $statistik['target'] }}" class="accordion-collapse collapse @php $is_active && print('show') @endphp" data-bs-parent="#statistikNavigation" aria-labelledby="heading-{{ $statistik['target']}}">
        <div class="accordion-body">
          <ul class="divide-y dark:divide-dark-primary">
            @foreach($statistik['submenu'] as $submenu) 
              @php
                $stat_slug = in_array($statistik['target'], ['statistikBantuan', 'statistikLainnya']) ? str_replace('first/', '', $submenu['url']) : 'statistik/' . $submenu['key'];
                if($stat_slug == 'data-dpt'){
                  $stat_slug = 'dpt';
                }
              @endphp
              
              @if (isset($statistik_aktif[$stat_slug])) 
                @php $url = str_replace('first/statistik', 'data-statistik', $submenu['url']) @endphp
                <li><a href="{{ site_url($url) }}" class="px-5 py-2 block {{ $submenu['slug'] == $slug_aktif ? 'bg-primary text-white' : 'hover:cursor-pointer hover:text-primary dark:text-white' }}">{{ $submenu['label'] }}</a></li>
              @endif
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  @endforeach
</div>

@push('styles')
  <style>
    .accordion-button:not(.collapsed) {
      color: var(--primary-color);
    }
    .dark .accordion-button:not(.collapsed) {
      color: #eee;
    }
  </style>
@endpush