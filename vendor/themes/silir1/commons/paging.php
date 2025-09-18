<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php if($paging->num_rows > $paging->per_page) : ?>
  <span class="block text-sm">Halaman <?= $paging->page ?> dari <?= $paging->end_link ?></span>
  <nav aria-label="nomor halaman">
    <ul class="pagination mt-1 mb-5">
      <?php if($paging->start_link) : ?>
        <li>
          <a href="<?= site_url($paging_page.'/'.$paging->start_link)?>" class="pagination-link"><i class="ti ti-chevrons-left icon-base inline-block"></i></a>
        </li>
      <?php endif ?>
      <?php if($paging->prev) : ?>
        <li>
          <a href="<?= site_url($paging_page.'/'.$paging->prev.$paging->suffix)?>" class="pagination-link"><i class="ti ti-chevron-left icon-base inline-block"></i></a>
        </li>
      <?php endif ?>
      <?php for($page = $p-2; $page <= $p+3; $page++) : ?>
        <?php if($page > 0 && $page <= $paging->end_link) : ?>
          <li>
            <a href="<?= site_url($paging_page.'/'.$page.$paging->suffix)?>" class="pagination-link <?php ($p == $page || $paging->page == $page) and print('is-active') ?>"><?= $page ?></a>
          </li>
        <?php endif ?>
      <?php endfor ?>
      <?php if($paging->next) : ?>
        <li>
          <a href="<?= site_url($paging_page.'/'.$paging->next.$paging->suffix)?>" class="pagination-link"><i class="ti ti-chevron-right icon icon-base inline-block"></i></a>
        </li>
      <?php endif ?>
      <?php if($paging->end_link) : ?>
        <li>
          <a href="<?= site_url($paging_page.'/'.$paging->end_link)?>" class="pagination-link"><i class="ti ti-chevrons-right icon icon-base inline-block"></i></a>
        </li>
      <?php endif ?>
    </ul>
  </nav>
<?php endif ?>
