
<aside class="sidebar">

  @include('theme::widgets.layanan_mandiri')

  @if($widgetAktif)
    @foreach($widgetAktif as $widget)
      @php
        $judul_widget = [
          'judul_widget' => str_replace('Desa', ucwords(setting('sebutan_desa')), strip_tags($widget['judul']))
        ];
      @endphp

      @if($widget['jenis_widget'] == 1)
        @if($widget['isi'] == 'layanan_mandiri' or $widget['isi'] == 'keuangan') 
          @php continue; @endphp
        @endif
        <div class="sidebar-item">
          @includeIf("widgets.{$widget['isi']}", $judul_widget)
        </div>
        @elseif($widget['jenis_widget'] == 2) 
          <div class="sidebar-item">
            <h3 class="sidebar-heading">{{ strip_tags($widget['judul']) }}</h3>
            <div class="sidebar-body">
              @includeIf("../../{$widget['isi']}", $judul_widget)
            </div>
          </div>
        @else 
          <div class="sidebar-item">
            <h3 class="sidebar-heading">{{ strip_tags($widget['judul']) }}</h3>
            <div class="sidebar-body">
              {!! html_entity_decode($widget['isi']) !!}
            </div>
          </div>
      @endif
    @endforeach
  @endif
  
</aside>