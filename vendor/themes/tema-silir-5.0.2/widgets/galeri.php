<!-- widget Galeri-->
<div class="box box-primary box-solid">
  <div class="box-header">
    <h3 class="box-title"><a href="<?= site_url('galeri'); ?>"><i class="ti ti-camera mr-1"></i> Galeri Foto</a></h3>
  </div>
  <div class="box-body">
    <div class="sidebar-latest" style="max-height: 250px; overflow: auto">
      <?php foreach($w_gal as $album) : ?>
        <?php $link = site_url('galeri/'.$album['id']) ?>
        <?php $image_src = $album['jenis'] == 1 ? AmbilGaleri($album['gambar'], 'kecil') : $album['gambar'] ?>
        <a href="<?= $link ?>" class="footer-album-item">
          <img loading="lazy" src="<?= $image_src ?>" alt="<?= $album['nama'] ?>" title="<?= $album['nama'] ?>" class="footer-album-image">
        </a>
      <?php endforeach ?>
    </div>
  </div>
</div>
