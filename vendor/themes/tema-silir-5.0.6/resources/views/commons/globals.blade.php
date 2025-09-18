@php
  $theme_version = 'v5.0.6';
  $theme_timestamp = '20250224';
  $is_premium = preg_match('/premium/', ambilVersi());
  $nama_desa =  ucwords(setting('sebutan_desa')) . ' ' . ucwords($desa['nama_desa']);
  $is_ramadhan = true && date('Y-m-d') <= date('2024-04-15');
  $theme_color = theme_config('theme_color');

  view()->share('theme_version', $theme_version);
  view()->share('theme_timestamp', $theme_timestamp);
  view()->share('is_premium', $is_premium);
  view()->share('nama_desa', $nama_desa);
  view()->share('is_ramadhan', $is_ramadhan);
  view()->share('theme_color', $theme_color);
@endphp