@php $layout = 'full-content' @endphp
@extends('theme::layouts.master')

@section('content')
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i
      class="ti ti-users"></i> {{ ucwords(setting('sebutan_pemerintah_desa')) }}</h1>
  <div id="loading">@include('theme::commons.loading')</div>
  <div class="grid grid-cols-1 lg:grid-cols-4 gap-3 lg:gap-5 py-5" id="pemerintah-list"></div>
  @include('theme::commons.pagination')
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      function loadPemerintah(params = {}) {
        const apiPemerintah = '{{ route("api.pemerintah") }}';

        $('#pagination-container').hide();

        $.get(apiPemerintah, params, function (data) {
          const pemerintah = data.data;
          let pemerintahList = $('#pemerintah-list');
          pemerintahList.empty();
          $('#loading').remove();

          if (!pemerintah.length) {
            pemerintahList.html(`<p class="py-2"> ${setting.sebutan_pemerintah_desa} tidak tersedia.</p>`);
            return;
          }

          const mediaSosialPlatforms = JSON.parse(setting.media_sosial_pemerintah_desa);

          pemerintah.forEach(function (item) {
            let mediaSosial = '';
            const mediaSosialPengurus = item.attributes.media_sosial || {};

            mediaSosialPlatforms.forEach((platform) => {
              const link = mediaSosialPengurus[platform];
              mediaSosial += `
                  <a href="${link}" target="_blank" class="inline-flex items-center justify-center p-2 w-8 h-8 bg-secondary rounded-full text-white">
                      <i class="ti ti-brand-${platform}"></i>
                  </a>
              `;
            });

            const pemerintahHTML = `
                <div class="space-y-3 border p-3 pt-5">
                    <img class="w-1/2 mx-auto h-auto shadow-none" src="${item.attributes.foto || ''}" alt="Foto ${item.attributes.nama}" />
                    <div class="space-y-1 text-sm text-center z-10 mx-auto">
                        <span class="font-bold">${item.attributes.nama}</span>
                        <span class="block">${item.attributes.nama_jabatan}</span>
                        ${item.attributes.pamong_niap ? `<span class="block">${item.attributes.sebutan_nip_desa}: ${item.attributes.pamong_niap}</span>` : ''}
                        ${item.attributes.kehadiran == 1 ? `
                            <span class="${item.attributes.status_kehadiran === 'hadir' ? 'bg-emerald-500' : 'bg-red-500'} text-white py-1 px-3 rounded inline-block">
                                ${item.attributes.status_kehadiran === 'hadir' ? 'Hadir' : item.attributes.status_kehadiran}
                            </span>` : ''}
                        <div class="flex flex-wrap gap-2 py-3 justify-center">${mediaSosial}</div>
                    </div>
                </div>
            `;

            pemerintahList.append(pemerintahHTML);
          });

          initPagination(data);
        });
      }

      $('#pagination-container').on('click', '.pagination-link', function () {
        const params = {};
        const page = $(this).data('page');
        params['page[number]'] = page;
        loadPemerintah(params);
      });

      loadPemerintah();
    });
  </script>
@endpush