<!DOCTYPE html>
<html lang="en">
<head>
  @include('theme::commons.globals')
  @include('theme::commons.meta')
  @include('theme::commons.source_css')
  @yield('title')
  @stack('styles')
</head>
<body data-theme="{{ $theme_color }}" x-data="{ drawer: false }">
  @include('theme::commons.loading_screen')
  @include('theme::commons.customizer')

  @yield('layout')

  @include('theme::commons.footer')
  @include('theme::commons.source_js')
  @stack('scripts')
  <script src="{{ theme_asset('js/script.min.js?' . $theme_version) }}"></script>
</body>
</html>