<div class="box box-primary box-solid">
  <div class="box-header">
    <h3 class="box-title"><i class="ti ti-list mr-1"></i> Kategori</h3>
  </div>
  <div class="box-body">
    <ul class="divide-y">
      @foreach($menu_kiri as $data)
        <li><a href="{{ site_url('artikel/kategori/' . $data['slug']) }}" class="py-2 block">{{ $data['kategori'] }}</a>
          @if(count($data['submenu'] ?? []) > 0)
            <ul class="divide-y">
              @foreach($data['submenu'] as $submenu)
              <li><a href="{{ site_url('artikel/kategori/' . $submenu['slug']) }}"
                  class="py-2 block">{{ $submenu['kategori'] }}</a></li>
              @endforeach
            </ul>
          @endif
        </li>
      @endforeach
    </ul>
  </div>
</div>