@extends('theme::layouts.master')

@section('content')
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i
      class="ti ti-report-analytics"></i> <span id="indikator"></span></h1>
  <div class="main-content space-y-5">
    <div class="ui-layout-center" id="chart" style="padding: 5px;"></div>
    <table class="table table-responsive table-striped" id="table-jawaban">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th>Jawaban</th>
          <th width="5%">Jumlah Responden</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="2">@inluce('commons.loading')</td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection

@push('scripts')
  <script>
    $.get(`{{ route('api.analisis.indikator') . "?filter[id]={$params['filter']['id_indikator']}" }}`,
      function (data) {
        const indikator = data?.data[0]?.attributes?.indikator;

        // Set the text dynamically
        $('#indikator').text(indikator);

        // Initialize the Highcharts with the fetched indikator value
        printChart(indikator);
      });

    const tabelData = $('#table-jawaban').DataTable({
      processing: true,
      serverSide: true,
      autoWidth: false,
      ordering: false,
      searching: false,
      ajax: {
        url: ''{{ route('api.analisis.jawaban') }}',
        method: 'GET',
        data: row => ({
          ...@json($params),
          "page[size]": row.length,
          "page[number]": (row.start / row.length) + 1,
        }),
        dataSrc: json => {
          json.recordsTotal = json.meta.pagination.total;
          json.recordsFiltered = json.meta.pagination.total;
          return json.data;
        },
        error: function (xhr) {
          console.error('AJAX Error:', xhr.responseText);
        }
      },
      columnDefs: [{
        targets: '_all',
        className: 'text-nowrap'
      }],
      columns: [{
          data: null,
          searchable: false,
          orderable: false
        },
        {
          data: 'attributes.jawaban',
        },
        {
          data: 'attributes.jml',
        }
      ],
      drawCallback: function (settings) {
        var api = this.api();

        // Update row numbering
        api.column(0, {
          search: 'applied',
          order: 'applied'
        }).nodes().each(function (cell, i) {
          cell.innerHTML = api.page.info().start + i + 1;
        });

        // Extract data for the chart
        var chartCategories = [];
        var chartData = [];

        api.rows().data().each(function (row) {
          chartCategories.push(row.attributes.jawaban); // Add the "jawaban" as category
          chartData.push(row.attributes.jml); // Add the "jml" as data
        });

        // Update the chart with new data
        updateChart(chartCategories, chartData);
      }
    });

    printChart();

    function printChart(indikator) {
      chart = new Highcharts.Chart({
        chart: {
          renderTo: 'chart',
          border: 0,
          defaultSeriesType: 'column'
        },
        title: {
          text: indikator
        },
        xAxis: {
          title: {
            text: ''
          },
          categories: []
        },
        yAxis: {
          title: {
            text: 'Jumlah Populasi'
          }
        },
        legend: {
          layout: 'vertical',
          enabled: false
        },
        plotOptions: {
          series: {
            colorByPoint: true
          },
          column: {
            pointPadding: 0,
            borderWidth: 0
          }
        },
        series: [{
          shadow: 1,
          border: 0,
          data: []
        }]
      });
    }

    function updateChart(categories, data) {
      // Update the categories and data in the chart
      chart.xAxis[0].setCategories(categories);
      chart.series[0].setData(data);
    }
  </script>
@endpush