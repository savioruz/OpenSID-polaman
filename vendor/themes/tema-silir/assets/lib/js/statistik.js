let showMore = true;
let statChart;

function showHideToggle() {
  $('#showData').click(); // Simulates a click on the `#showData` element
  showZeroValue(showMore); // Toggles zero values based on `showMore`
  showMore = !showMore; // Flip the `showMore` flag
  if (showMore) {
    $('#showZero').text('Tampilkan Nol'); // Update button text
  } else {
    $('#showZero').text('Sembunyikan Nol');
  }
}

function showZeroValue(show = false) {
  if (show) {
    $('.zero').closest('tr').show();
  } else {
    $('.zero').closest('tr').hide();
  }
}

function switchType(type, alpha) {
  statChart.update({
    chart: {
      options3d: {
        alpha: alpha, // Set the 3D angle for the chart
      },
    },
    series: [{
      type: type, // Update the chart type (e.g., 'pie', 'column')
    }],
  });
}

// Fetch data using AJAX and return a Promise
function fetchDataStats() {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: statistikUrl,
      method: 'get',
      data: {},
      beforeSend: function () {
        $('#showData').hide();
      },
      success: function (json) {
        const dataStats = json.data.map(item => {
          const {
            id
          } = item;
          const {
            nama,
            jumlah,
            laki,
            perempuan,
            persen,
            persen1,
            persen2,
          } = item.attributes;
          return {
            id,
            nama,
            jumlah,
            laki,
            perempuan,
            persen,
            persen1,
            persen2,
          };
        });
        resolve(dataStats); // Resolve the promise once dataStats is ready
      },
      error: function (error) {
        console.error('Error fetching data:', error);
        reject(error); // Reject the promise on error
      },
    });
  });
}

// Initialize the chart after dataStats is ready
function initializeChart(dataStats) {
  const categories = [];
  const data = [];

  for (const stat of dataStats) {
    if (stat.nama !== 'TOTAL' && stat.nama !== 'JUMLAH' && stat.nama !== 'PENERIMA') {
      const filteredData = [stat.nama, parseInt(stat.jumlah, 10)];
      categories.push(stat.nama);
      data.push(filteredData);
    }
  }

  statChart = new Highcharts.Chart({
    chart: {
      renderTo: 'statistics-one',
      options3d: {
        enabled: enable3d,
        alpha: 45,
        beta: 10,
      },
    },
    title: 0,
    yAxis: {
      showEmpty: false,
      title: {
        text: 'Jumlah Populasi',
      },
    },
    xAxis: {
      categories: categories,
    },
    plotOptions: {
      series: {
        colorByPoint: true,
      },
      column: {
        pointPadding: -0.1,
        borderWidth: 0,
        showInLegend: false,
        depth: 50,
        viewDistance: 25,
      },
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        showInLegend: false,
        depth: 30,
        innerSize: 30,
      },
    },
    legend: {
      enabled: true,
    },
    series: [{
      type: 'pie',
      name: 'Jumlah Populasi',
      shadow: 1,
      border: 1,
      data: data,
    }, ],
  });
}

// Populate table rows
function populateTable(dataStats) {
  const table = document.getElementById('statistic-table');
  const tbody = table.querySelector('tbody');
  let _showBtnSelengkapnya = false;

  tbody.innerHTML = ''; // Clear existing rows

  dataStats.forEach((item, index) => {
    const row = document.createElement('tr');
    if (index > 11 && !['666', '777', '888'].includes(item['id'])) {
      row.className = 'more';
      _showBtnSelengkapnya = true;
    }
    for (let key in item) {
      const cell = document.createElement('td');
      let text = item[key];
      let className = 'text-right';
      if (key === 'id') {
        className = 'text-center';
        text = index + 1;
        if (['666', '777', '888'].includes(item[key])) {
          text = '';
        }
      }
      if (key === 'nama') {
        className = 'text-left';
      }
      if (key === 'jumlah' && item[key] <= 0) {
        if (!['666', '777', '888'].includes(item['id'])) {
          className += ' zero';
        }
      }
      cell.className = className;
      cell.textContent = text;
      row.appendChild(cell);
    }
    tbody.appendChild(row);
  });

  if (_showBtnSelengkapnya) {
    $('#showData').show();
  }
  $('#statistics-one').trigger('change');
}

$(document).ready(() => {
  // Wait for dataStats to load, then proceed
  fetchDataStats()
    .then((dataStats) => {
      // Initialize chart and populate table after dataStats is ready
      if ($('#statistics-one').length) {
        initializeChart(dataStats);
      }
      populateTable(dataStats);
      showZeroValue(false);

      $('#showZero').click(() => showHideToggle());

      $('.button-switch').click(function () {
        const chartType = $(this).data('type'); // Get chart type from the button's `data-type` attribute
        const alpha = chartType === 'pie' ? 45 : 20; // Use 45° for pie statChart and 20° for other types
        $(this).addClass('is-active'); // Mark the clicked button as active
        $(this).siblings('.button-switch').removeClass('is-active'); // Deactivate other buttons
        $(this).prop('disabled', true);
        $(this).siblings('.button-switch').prop('disabled', false);
        switchType(chartType, alpha); // Call the function to update the chart
      });

      $('#showData').click(() => {
        $('tr.more').show();
        $('#showData').hide();
        showZeroValue(false);
      });

      // Additional setup
      if ($('#peserta_program_bantuan').length) {
        const pesertaDatatable = $('#peserta_program_bantuan').DataTable({
          processing: true,
          serverSide: true,
          order: [],
          ajax: {
            url: bantuanUrl,
            type: 'GET',
            data: function (row) {
              const orderColumn = row.order[0] ? row.order[0].column : null;
              const orderDir = row.order[0] ? row.order[0].dir : "asc";
              const columnName = orderColumn !== null ? row.columns[orderColumn].name : "";
              return {
                "page[size]": row.length,
                "page[number]": (row.start / row.length) + 1,
                "filter[search]": row.search.value,
                "sort": (orderDir === "asc" ? "" : "-") + columnName,
              };
            },
            dataSrc: function (json) {
              json.recordsTotal = json.meta.pagination.total;
              json.recordsFiltered = json.meta.pagination.total;
              return json.data;
            },
          },
          columns: [
            {
              data: null,
            },
            {
              data: 'attributes.nama',
              name: 'nama'
            },
            {
              data: 'attributes.kartu_nama',
              name: 'kartu_nama'
            },
            {
              data: 'attributes.kartu_alamat',
              name: 'kartu_alamat',
              orderable: false,
              searchable: false
            },
          ],
          order: [1, 'asc'],
          language: {
            url: `${BASE_URL}/assets/bootstrap/js/dataTables.indonesian.lang`
          },
          drawCallback: function () {
            $('.dataTables_paginate > .pagination').addClass('pagination-sm no-margin');
          }
        });
        
        pesertaDatatable.on('draw.dt', function () {
          const PageInfo = $('#peserta_program_bantuan').DataTable().page.info();
          pesertaDatatable.column(0, {
            page: 'current'
          }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
          });
        });        
      }
    })
    .catch((error) => {
      console.error('Initialization failed:', error);
    });

  $('#tahun').change(function () {
    const current_url = window.location.href.split('?')[0];
    window.location.href = `${current_url}?tahun=${$(this).val()}`;
  });
});