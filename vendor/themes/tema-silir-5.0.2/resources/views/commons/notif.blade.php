@if (session('success'))
    <div id="notifikasi" class="alert relative alert-success alert-dismissible">
      <button type="button" class="absolute right-0 top-0 mr-2 mt-2 w-5 h-5" data-dismiss="alert" aria-hidden="true"><i class="ti ti-times inline-block icon-base"></i></button>
      <p class="font-bold"><i class="icon ti ti-check"></i> Berhasil</p>
      <p class="text-sm">{!! session('success') !!}</p>
    </div>
@endif

@if (session('error'))
    <div @if (session('autodismiss')) @else id="notifikasi" @endif class="alert relative alert-danger alert-dismissible">
      <button type="button" class="absolute right-0 top-0 mr-2 mt-2 w-5 h-5" data-dismiss="alert" aria-hidden="true"><i class="ti ti-times inline-block icon-base"></i></button>
      <p class="font-bold"><i class="icon ti ti-ban"></i> Gagal</p>
      <p class="text-sm">{!! is_array(session('error')) ? implode(', ',session('error')) : session('error') !!}</p>
    </div>
@endif

@if ($errors->any())
    <div @if (session('autodismiss')) @else id="notifikasi" @endif class="alert relative alert-danger alert-dismissible">
      <button type="button" class="absolute right-0 top-0 mr-2 mt-2 w-5 h-5" data-dismiss="alert" aria-hidden="true"><i class="ti ti-times inline-block icon-base"></i></button>
      <p class="font-bold"><i class="icon ti ti-ban"></i> Gagal</p>
      <ul>
        @foreach ($errors->all() as $item)
          <li class="text-sm">{{ $item }}</li>
        @endforeach
      </ul>
    </div>
@endif

@if (session('warning'))
    <div id="notifikasi" class="alert relative alert-warning bg- alert-dismissible">
      <button type="button" class="absolute right-0 top-0 mr-2 mt-2 w-5 h-5" data-dismiss="alert" aria-hidden="true"><i class="ti ti-times inline-block icon-base"></i></button>
      <p class="font-bold"><i class="icon ti ti-warning"></i> Peringatan</p>
      <p class="text-sm">{!! session('warning') !!}</p>
    </div>
@endif

@if (session('information'))
    <div id="notifikasi" class="alert relative alert-info alert-dismissible">
      <button type="button" class="absolute right-0 top-0 mr-2 mt-2 w-5 h-5" data-dismiss="alert" aria-hidden="true"><i class="ti ti-times inline-block icon-base"></i></button>
      <p class="font-bold"><i class="icon ti ti-info"></i> Informasi</p>
      <p class="text-sm">{!! session('information') !!}</p>
    </div>
@endif

@push('styles')
  <style>
    .alert-success {
      background-color: #c3e6cb;
      border-color: #c3e6cb;
      color: #3c763d;
    }

    .alert-danger {
      background-color: #f5c6cb;
      border-color: #f5c6cb;
      color: #a94442;
    }

    .alert-warning {
      background-color: #ffeeba;
      border-color: #ffeeba;
      color: #8a6d3b;
    }

    .alert-info {
      background-color: #bee5eb;
      border-color: #bee5eb;
      color: #31708f;
    }
  </style>
@endpush