<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.2.0/highcharts.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.2.0/highcharts-3d.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.2.0/highcharts-more.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.2.0/modules/sankey.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.2.0/modules/organization.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.2.0/modules/exporting.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.2.0/modules/accessibility.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

<?= view('admin.layouts.components.token') ?>

<script>
  $.extend($.fn.dataTable.defaults, {
  lengthMenu: [
  [10, 25, 50, 100, -1],
  [10, 25, 50, 100, "Semua"]
  ],
  pageLength: 10,
  language: {
  url: "<?= asset('bootstrap/js/dataTables.indonesian.lang') ?>",
  }
  });
</script>

<?php if (! setting('inspect_element')): ?>
  <script src="<?= asset('js/disabled.min.js') ?>"></script>
<?php endif ?>