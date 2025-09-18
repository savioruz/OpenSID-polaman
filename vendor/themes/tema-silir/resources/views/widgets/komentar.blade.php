<div class="box box-primary box-solid">
  <div class="box-header">
    <h3 class="box-title"><i class="ti ti-messages mr-1"></i> Komentar Terbaru</h3>
  </div>
  <div class="box-body">
    <marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="2" direction="up" width="100%" height="100" align="center">
      <ul class="sidebar-latest" id="li-komentar">
        @foreach($komen as $data)
          <li>
            <i class="ti ti-message"></i> {{ $comment['pengguna']['nama'] }}<br/>
            <small>{{ tgl_indo2($data['tgl_upload']) }}</small><br/>
            {{ potong_teks($data['komentar'], 50) }}...<a href="{{ site_url('artikel/' . buat_slug($data)); }}">selengkapnya</a>
            <br />
            <br />
          </li>
        @endforeach
      </ul>
    </marquee>
  </div>
</div>
