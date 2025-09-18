<div class="box box-primary box-solid">
  <div class="box-header">
    <h3 class="box-title"><i class="ti ti-chart-bar mr-1"></i> Statistik Pengunjung</h3>
  </div>
  <div class="box-body">
    <table cellpadding="0" cellspacing="0" class="table w-full">
      <tr>
        <td class="description">Hari ini</td>
        <td class="dot">:</td>
        <td class="case">{{ ribuan($statistik_pengunjung['hari_ini']) }}</td>
      </tr>
      <tr>
        <td class="description">Kemarin</td>
        <td class="dot">:</td>
        <td class="case">{{ ribuan($statistik_pengunjung['kemarin']) }}</td>
      </tr>
      <tr>
        <td class="description">Total Pengunjung</td>
        <td class="dot">:</td>
        <td class="case">{{ ribuan($statistik_pengunjung['total']) }}</td>
      </tr>
      <tr>
        <td class="description">Sistem Operasi</td>
        <td class="dot">:</td>
        <td class="case">{{ $statistik_pengunjung['os'] }}</td>
      </tr>
      <tr>
        <td class="description">IP Address</td>
        <td class="dot">:</td>
        <td class="case">{{ $statistik_pengunjung['ip_address'] }}</td>
      </tr>
      <tr>
        <td class="description">Browser</td>
        <td class="dot">:</td>
        <td class="case">{{ $statistik_pengunjung['browser'] }}</td>
      </tr>
    </table>
  </div>
</div>