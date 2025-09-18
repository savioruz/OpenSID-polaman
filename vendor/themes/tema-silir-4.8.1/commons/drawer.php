<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="lg:hidden bg-black/50 fixed left-0 top-0 bottom-0 right-0 w-full h-full z-30" @click="drawer = !drawer" x-show="drawer"></div>
<nav class="bottom-0 bg-slate-50 fixed top-0 w-10/12 z-40 shadow-lg transition-all duration-500 transform pb-16 h-auto overflow-y-auto lg:w-96 lg:overflow-visible lg:bottom-0 -translate-x-full"
  :class="{'-translate-x-full': !drawer, 'translate-x-0': drawer}" id="sidenav">
  <div class="bg-tertiary text-white py-3 px-3 text-center">MENU</div>
  <ul class="relative block divide-y">
    <?php if(!IS_PREMIUM) : ?>
      <?php $id = 0 ?>
      <?php foreach($menu_atas as $menu) : ?>
        <?php $id++ ?>
        <li class="relative" id="nav-<?= $id ?>">
          <a href="<?= $menu['link'] ?>" class="flex items-center justify-between text-sm py-3 px-4 h-12 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-gray-900 hover:bg-gray-100 transition duration-300 ease-in-out cursor-pointer" data-mdb-ripple="true" data-mdb-ripple-color="dark"
          <?php if(count($menu['submenu']) > 0) : ?>
            data-bs-toggle="collapse" data-bs-target="#collapsemenu<?= $id ?>" aria-expanded="true" aria-controls="collapsemenu<?= $id ?>"
          <?php endif ?>
          >
            <span><i class="ti ti-menu mr-1"></i>
            <?= $menu['nama'] ?></span>
            <?php if(count($menu['submenu']) > 0) : ?>
              <span class="ti ti-chevron-down text-lg inline-block font-bold"></span>
            <?php endif ?>
          </a>
          <?php if(count($menu['submenu']) > 0) : ?>
            <ul class="relative accordion-collapse collapse" id="collapsemenu<?= $id ?>" aria-labelledby="nav<?= $id ?>" data-bs-parent="#sidenav">
              <?php foreach($menu['submenu'] as $submenu) : ?>
                <li class="relative">
                  <a href="<?= $submenu['link'] ?>" class="flex py-2 pl-8 pr-3 text-sm overflow-hidden text-gray-700 text-ellipsis whitespace-wrap rounded hover:text-gray-900 hover:bg-gray-100 transition duration-300 ease-in-out" data-mdb-ripple="true" data-mdb-ripple-color="dark"><i class="ti ti-chevron-right mr-1"></i><?= $submenu['nama'] ?></a>
                </li>
              <?php endforeach ?>
            </ul>
          <?php endif ?>
        </li>
      <?php endforeach ?>
      <?php else : ?>
        <?php if(menu_tema()) : ?>
          <?php 
          function generateMenu($menuItems, $idPrefix = '') {
            $html = '<ul class="ml-2 relative accordion-collapse collapse" id="collapsemenu' . $idPrefix . '" aria-labelledby="nav' . $idPrefix . '" data-bs-parent="#sidenav'.$idPrefix.'">';
            foreach ($menuItems as $id => $menu) {
                $has_dropdown = isset($menu['childrens']) && count($menu['childrens']) > 0;
                $html .= '<li class="relative" id="nav-' . $idPrefix . '-' . $id . '">';
                $html .= '<a href="' . $menu['link_url'] . '" class="flex items-center justify-between text-sm py-3 px-4 h-12 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-gray-900 hover:bg-gray-100 transition duration-300 ease-in-out cursor-pointer"';
                if ($has_dropdown) {
                    $html .= ' data-bs-toggle="collapse" data-bs-target="#collapsemenu' . $idPrefix . '-' . $id . '" aria-expanded="true" aria-controls="collapsemenu' . $idPrefix . '-' . $id . '"';
                }
                $html .= '>';
                $html .= '<span><i class="ti ti-menu mr-1"></i>' . $menu['nama'] . '</span>';
                if ($has_dropdown) {
                    $html .= '<span class="ti ti-chevron-down text-lg inline-block font-bold"></span>';
                }
                $html .= '</a>';
                if ($has_dropdown) {
                    $html .= generateMenu($menu['childrens'], $idPrefix . '-' . $id);
                }
                $html .= '</li>';
            }
            $html .= '</ul>';
            return $html;
          }
          ?>

        <?php foreach(menu_tema() as $id => $menu) : ?>
          <?php $has_dropdown = isset($menu['childrens']) && count($menu['childrens']) > 0; ?>
          <li class="relative" id="nav-<?= $id ?>">
            <a href="<?= $menu['link_url'] ?>" class="flex items-center justify-between text-sm py-3 px-4 h-12 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-gray-900 hover:bg-gray-100 transition duration-300 ease-in-out cursor-pointer" data-mdb-ripple="true" data-mdb-ripple-color="dark"
            <?php if($has_dropdown) : ?>
              data-bs-toggle="collapse" data-bs-target="#collapsemenu<?= $id ?>" aria-expanded="true" aria-controls="collapsemenu<?= $id ?>"
            <?php endif ?>
            >
              <span><i class="ti ti-menu mr-1"></i>
              <?= $menu['nama'] ?></span>
              <?php if($has_dropdown) : ?>
                <span class="ti ti-chevron-down text-lg inline-block font-bold"></span>
              <?php endif ?>
            </a>
            <?php if($has_dropdown) : ?>
              <?= generateMenu($menu['childrens'], $id) ?>
            <?php endif ?>
          </li>
        <?php endforeach ?>
      <?php endif ?>
    <?php endif ?>
  </ul>
</nav>