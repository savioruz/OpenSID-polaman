<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php $alt_slug = IS_PREMIUM ? 'artikel' : 'first'; ?>
<div class="backdrop"></div>
<nav class="secondary-navigation">
  <div class="secondary-navigation-heading">Kategori</div>
  <ul class="secondary-navigation-list">
    <?php foreach($menu_kiri as $menu) : ?>
      <li class="secondary-navigation-item">
        <a href="<?= site_url("{$alt_slug}/kategori/{$menu['slug']}") ?>" class="secondary-navigation-link">
          <?= $menu['kategori'] ?>
          <?php if(count($menu['submenu']) > 0) : ?>
            <i class="ti ti-chevron-right secondary-navigation-icon"></i>
          <?php endif ?>
        </a>
        <?php if(count($menu['submenu']) > 0) : ?>
          <ul class="secondary-navigation-dropdown">
            <?php foreach($menu['submenu'] as $submenu) : ?>
              <li class="secondary-navigation-dropdown-item">
                <a href="<?= site_url("{$alt_slug}/kategori/{$submenu['slug']}") ?>" class="secondary-navigation-dropdown-link"><?= $submenu['kategori'] ?></a>
              </li>
            <?php endforeach ?>
          </ul>
        <?php endif ?>
      </li>
    <?php endforeach ?>
  </ul>
</nav>