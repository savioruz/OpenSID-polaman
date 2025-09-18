<div class="loading">
  <div class="pt-20">
    <img loading="lazy" src="{{ gambar_desa($desa['logo']) }}" alt="Logo {{ ucwords(setting('sebutan_desa')).' '.ucwords($desa['nama_desa']) }}" style="height: 6rem" class="w-auto mx-auto pb-2">
    @include('theme::commons.loading')
  </div>
  <p class="py-8 font-medium text-sm dark:text-white">Aplikasi Sistem Informasi {{ ucwords(setting('sebutan_desa')).' '.ucwords($desa['nama_desa']) }}</p>
  </div>
</div>