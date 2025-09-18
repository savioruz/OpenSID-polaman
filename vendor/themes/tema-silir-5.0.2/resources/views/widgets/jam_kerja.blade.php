<div class="box box-primary box-solid">
  <div class="box-header">
    <h3 class="box-title"><i class="ti ti-clock"></i> Jam Kerja</h3>
  </div>
  <div class="box-body">
      @if($jam_kerja) 
        <table class="w-full table border text-center jam-kerja" cellpadding="0" cellspacing="0">
          <thead>
            <tr>
              <th>Hari</th>
              <th>Mulai</th>
              <th>Selesai</th>
            </tr>
          </thead>
          <tbody>
            @foreach($jam_kerja as $value) 
            <tr>
              <td>{{ $value->nama_hari }}</td>
              @if($value->status) 
                <td>{{ $value->jam_masuk }}</td>
                <td>{{ $value->jam_keluar }}</td>
              @else 
                <td colspan="2"><span class="bg-red-500 text-white py-1 px-3 rounded inline-block"> Libur </span></td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </div>
</div>
@push('styles')
  <style>
    .jam-kerja td, .jam-kerja th {
      border: 1px solid #eee;
      padding: 5px 8px;
    }
    .jam-kerja tr {
      border: 1px solid #eee;
    }
    .jam-kerja tr:nth-child(even) {
      background-color: #efefef;
    }
    .dark .jam-kerja tr:nth-child(even) {
      background-color: #1a202c;
    }
    .jam-kerja th {
      background-color: var(--primary-color);
      color: #fff;
    }
  </style>
@endpush