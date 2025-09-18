<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 container">
  <?php foreach($widgets as $item): ?>
  <div class="shadow  <?= $item['bg-color'] ?>-300 rounded-lg">
    <div class="p-4 flex flex-row gap-3">
      <div class="text-5xl">
        <i class="ion <?= $item['icon'] ?>"></i>
      </div>
      <div class="flex-grow pl-6">
        <p class="text-gray-400"><?= $item['title'] ?></p>
        <p class="text-3xl font-bold"><?= $item['total'] ?></p>
      </div>
    </div>
  </div>
  <?php endforeach ?>
</div>
<style>
  .bg-blue-300 {
    background-color: #93c5fd;
  }

  .bg-gray-300 {
    background-color: #d1d5db;
  }

  .bg-green-300 {
    background-color: #c3e6cb;
  }

  .bg-yellow-300 {
    background-color: #f5d079;
  }

  .bg-red-300 {
    background-color: #f87171;
  }
</style>