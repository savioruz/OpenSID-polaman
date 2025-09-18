<section class="flex lg:space-x-4 mt-1 mb-5 space-y-4 lg:space-y-0 flex-col lg:flex-row">
  @php $index = 0 @endphp
  @foreach($data_widget as $subdata_name => $subdatas) 
    <div class="card w-full apbdesa">
      <h3 class="card-heading is-bordered">
        {{
        \Illuminate\Support\Str::of($subdatas['laporan'])
          ->when(setting('sebutan_desa') != 'desa', function (\Illuminate\Support\Stringable $string) {
            return $string->replace('Des', \Illuminate\Support\Str::of(setting('sebutan_desa'))->substr(0, 1)->ucfirst());
          });
        }}
      </h3>
      <div class="card-content space-y-2">
        @foreach($subdatas as $key => $subdata) 
          @if (is_array($subdata) && $subdata['judul'] != null && $key != 'laporan' && ($subdata['realisasi'] != 0 || $subdata['anggaran'] != 0))
            <div class="group">
              <span class="text-sm font-bold">
                {{
                \Illuminate\Support\Str::of($subdata['judul'])
                  ->title()
                  ->whenEndsWith('Desa', function (\Illuminate\Support\Stringable $string) {
                    if (!in_array($string, ['Dana Desa'])) {
                      return $string->replace('Desa', setting('sebutan_desa'));
                    }
                  })
                  ->title();
                }}
              </span>
              <div class="text-sm flex justify-between">
                <span>{{ rupiah24($subdata['realisasi']) }}</span>
                <span>{{ rupiah24($subdata['anggaran']) }}</span>
              </div>
              <div class="progress">
                <div class="progress-item" style="width:{{ $subdata['persen'] }}%">
                  <span class="progress-value">{{ $subdata['persen'] }}%</span>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>
    @php $index++ @endphp
  @endforeach
</section>