<div class="shadow  @@bg-color-300 rounded-lg py-2">
  <div class="p-4 flex flex-row gap-3">
    <div class="text-5xl">
      <i class="ion @@icon"></i>
    </div>
    <div class="flex-grow pl-6">
      <p class="text-gray-400">@@title</p>
      <p class="text-3xl">@@total</p>
    </div>
  </div>
</div>

@push('styles')
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
@endpush