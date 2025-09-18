@extends('theme::layouts.master')

@section('content')
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i
      class="ti ti-camera"></i> @if($is_detail) Album Galeri @else Album @endif {{  $title }}</h1>
  <div id="loading"></div>
  <div class="gallery main-content" id="galeri-list"></div>
  @include('theme::commons.pagination')
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      let parent = `{{ $parent }}`;
      let routeGaleri = `{{ ci_route('internal_api.galeri') }}`;
      let pageSizes = 6;
      let status = '';

      if (parent) {
        routeGaleri = `{{ ci_route('internal_api.galeri') }}/${parent}`;
        pageSizes = 6; 
      }

      const loadGaleri = function (pageNumber) {
        $.ajax({
          url: routeGaleri + `?sort=-tgl_upload&page[number]=${pageNumber}&page[size]=${pageSizes}`, // Gunakan pageSizes
          type: "GET",
          beforeSend: function () {
            const galeriList = document.getElementById('galeri-list');
            galeriList.innerHTML = '';
            $('#loading').html(`@include('theme::commons.loading')`);
          },
          dataType: 'json',
          success: function (data) {
            displayGaleri(data);
            initPagination(data);
          }
        });
      };

      const displayGaleri = function (dataGaleri) {
        const galeriList = document.getElementById('galeri-list');
        galeriList.innerHTML = '';
        $('#loading').empty();
        if(!dataGaleri.data.length) {
          galeriList.innerHTML = `<div class="alert text-primary-100">Maaf album galeri belum tersedia!</div>`
          return
        }			
        
        dataGaleri.data.forEach(item => {
          const card = document.createElement('div');								
          const image  = item.attributes.src_gambar ? `<img class="gallery-image" src="${item.attributes.src_gambar}" title="${item.attributes.nama}" alt="${item.attributes.nama}"/>` : ``
          card.innerHTML = `
            <a href="${item.attributes.parrent ? item.attributes.src_gambar : item.attributes.url_detail}" class="gallery-thumbnail" ${item.attributes.parrent ? `data-fancybox="images" data-caption="${item.attributes.nama}"`: ''}>
              ${image}
              <p class="py-2 bg-white dark:bg-dark-secondary">${item.attributes.nama}</p>
            </a>					
          `;				
          galeriList.appendChild(card);
        });			
      }		
      $('#pagination-container').on('click', '.pagination-link', function() {
        const params = {};
        const page = $(this).data('page');
        loadGaleri(page);
      });
      loadGaleri(1);
    });	
  </script>
@endpush