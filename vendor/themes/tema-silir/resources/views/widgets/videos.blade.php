@php
  $videos = [[
      'name' => 'Video Pertama',
      'link' => 'https://www.youtube.com/embed/zv2KxhlZyoo',
  ],
  [
      'name' => 'Video Kedua',
      'link' => 'https://www.youtube.com/embed/zv2KxhlZyoo',
  ],
  [
      'name' => 'Video Ketiga',
      'link' => 'https://www.youtube.com/embed/zv2KxhlZyoo',
  ]];
@endphp
  
<section class="py-2">
  <h3 class="rounded w-full text-heading tex-lg lg:text-xl text-center bg-white dark:bg-dark-secondary">
    <span class="inline-block px-4 py-3 mt-2">Galeri Video</span>
  </h3>
  <div class="card overflow-hidden p-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 auto-cols-auto gap-5">
    @foreach($videos as $index => $videos)
      <div class="column">
        <iframe width="100%" height="250px" src="{{ $videos['link'] }}" title="{{ $videos['name'] }}" frameborder="0" allow="accelerometer; autoplay; clipboard-white; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
        </iframe>
      </div>
    @endforeach
  </div>
</section>