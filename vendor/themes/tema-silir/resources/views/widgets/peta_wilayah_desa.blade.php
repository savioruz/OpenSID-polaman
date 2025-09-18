<!-- widget Peta Wilayah Desa -->
<div class="box box-primary box-solid">
  <div class="box-header">
    <h3 class="box-title">
    <i class="ti ti-map-pin mr-1"></i>
    {{'Wilayah ' . ucwords(setting('sebutan_desa')) }}</h3>
  </div>
  <div class="box-body">
    <div id="map_wilayah" style="height:200px;"></div>
    <a href="https://www.openstreetmap.org/#map=15/{{$desa['lat'] . '/' . $desa['lng']}}">Buka peta</a>
  </div>
</div>

@push('scripts')
  <script>
    //Jika posisi kantor desa belum ada, maka posisi peta akan menampilkan seluruh Indonesia
    @if(! empty($desa['lat']) && ! empty($desa['lng']))
      var posisi = [{{ $desa['lat'] . ',' . $desa['lng'] }}];
      var zoom = {{ $desa['zoom'] ?: 10 }};
    @else
      var posisi = [-1.0546279422758742,116.71875000000001];
      var zoom = 10;
    @endif

    //Style polygon
    var style_polygon = {
      stroke: true,
      color: '#FF0000',
      opacity: 1,
      weight: 2,
      fillColor: '#8888dd',
      fillOpacity: 0.5
    };

    var options = {
        maxZoom: {{ setting('max_zoom_peta') }},
        minZoom: {{ setting('min_zoom_peta') }},
    };

    var wilayah_desa = L.map('map_wilayah', options).setView(posisi, zoom);

    //Menampilkan BaseLayers Peta
    var baseLayers = getBaseLayers(wilayah_desa, '{{ setting('mapbox_key') }}');

    L.control.layers(baseLayers, null, {position: 'topright', collapsed: true}).addTo(wilayah_desa);

    @if(! empty($desa['path']))
      var polygon_desa = {{ $desa['path']  }};
      var kantor_desa = L.polygon(polygon_desa, style_polygon).bindTooltip("Wilayah {{ ucwords(setting('sebutan_desa')) }}").addTo(wilayah_desa);
      wilayah_desa.fitBounds(kantor_desa.getBounds());
    @endif
  </script>
@endpush
