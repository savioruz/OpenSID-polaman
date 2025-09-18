@if($teks_berjalan) 
  <div class="newsticker rounded-none text-sm">
    <h3 class="newsticker-heading py-1"><i class="ti ti-speakerphone text-lg"></i> <span class="newsticker-title">Sekilas Info</span></h3>
    <ul class="newsticker-list py-1">
      @foreach($teks_berjalan as $newsticker) 
        <li class="newsticker-item">
          {{ $newsticker['teks'] }}
          @if($newsticker['tautan']) 
          <a href="{{ $newsticker['tautan'] }}" class="newsticker-link"><i class=" ti ti-link icon icon-sm mr-2"></i> {{ $newsticker['judul_tautan'] }}</a>
          @endif
        </li>
      @endforeach
    </ul>
  </div>
@endif