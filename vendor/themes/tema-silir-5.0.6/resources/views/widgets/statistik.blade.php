<div class="box box-primary box-solid">
  <div class="box-header">
    <h3 class="box-title"><a href="{{ site_url('first/statistik/4') }}"><i class="ti ti-chart-histogram mr-1"></i> Statistik {{ ucwords(setting('sebutan_desa')),' ', $desa['nama_desa'];  }}</a></h3>
  </div>
  <div class="box-body">
    <div id="container_widget" style="width: 100%; height: 300px; margin: 0 auto"></div>
  </div>
</div>

@push('styles')
  <!-- widget Statistik -->
  <style type="text/css">
    .highcharts-xaxis-labels tspan
    {
      font-size: 8px;
    }
  </style>
@endpush

@push('scripts')
  <script type="text/javascript">
    $(function ()
    {
      var chart_widget;
      $(document).ready(function ()
      {
        // Build the chart
        chart_widget = new Highcharts.Chart(
        {
          chart:
          {
            renderTo: 'container_widget',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
          },
          title:
          {
            text: 'Jumlah Penduduk'
          },
          yAxis:
          {
            title:
            {
              text: 'Jumlah'
            }
          },
          xAxis:
          {
            categories:
            [
              @foreach($stat_widget as $data)
                @if($data['jumlah'] > 0 AND $data['nama']!= "JUMLAH")
                  ['{{ $data['jumlah'] }} <br> {{ $data['nama'] }}'],
                @endif
              @endforeach
            ]
          },
          legend:
          {
            enabled:false
          },
          plotOptions:
          {
            series:
            {
              colorByPoint: true
            },
            column:
            {
              pointPadding: 0,
              borderWidth: 0
            }
          },
          series: [
          {
            type: 'column',
            name: 'Populasi',
            data: [
              @foreach($stat_widget as $data)
                @if($data['jumlah'] > 0 AND $data['nama']!= "JUMLAH")
                  ['{{ $data['nama'] }}',{{ $data['jumlah'] }}],
                @endif
              @endforeach
            ]
          }]
        });
      });
    });
  </script>
@endpush
