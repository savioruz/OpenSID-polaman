@php $layout = 'full-content' @endphp
@extends('theme::layouts.master')

@section('content')
  <h1 class="text-heading text-lg lg:text-2xl border-b border-dotted border-primary dark:border-white pb-2 title"><i class="ti ti-mail inline-block mr-1"></i> Pengaduan</h1>
  <div class="bg-slate-200 dark:bg-dark-primary py-3 px-5 border-l-4 border-secondary my-5 space-y-3">
    <p class="text-sm text-justify">Layanan Pengaduan bagi warga {{ ucwords(setting('sebutan_desa')) .' '. ucwords($desa['nama_desa']) }},
            {{ ucwords(setting('sebutan_kecamatan')) .' '. ucwords($desa['nama_kecamatan']) }},
            {{ ucwords(setting('sebutan_kabupaten')) .' '. ucwords($desa['nama_kabupaten']) }} yang ingin menyampaikan keluhan dan laporan terkait penyelenggaraan pemerintahan {{ setting('sebutan_desa') }} dan pelaksanaan pembangunan.</p>
  </div>
  <form action="" method="get" id="search-form">
    <div class="flex gap-3 lg:w-7/12 flex-col lg:flex-row py-2">
      <button type="button" class="button button-primary flex-shrink-0" data-bs-toggle="modal" data-bs-target="#newpengaduan" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-square-rounded-plus text-lg mr-1 inline-block"></i> Ajukan Pengaduan</button>
      <select class="form-input inline-block select2" id="caristatus" name="caristatus">
        <option value="">Semua Status</option>
        <option value="1" {{ selected($caristatus, 1) }}>Menunggu Diproses</option>
        <option value="2" {{ selected($caristatus, 2) }}>Sedang Diproses</option>
        <option value="3" {{ selected($caristatus, 3) }}>Selesai Diproses</option>
      </select>
      <input type="text" name="ticket-query" placeholder="Cari pengaduan disini..." class="form-input inline-block">
      <button type="submit" class="button button-secondary" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-search"></i></button>
    </div>
  </form>
  
  @include('theme::commons.notif')
  <div id="loading"></div>
  <section class="grid grid-cols-1 lg:grid-cols-2 gap-5 py-2" id="ticket-list">
  </section>
  @include('theme::commons.pagination')

  <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="ticket-detail" tabindex="-1" role="dialog" aria-labelledby="ticket-detail" aria-hidden="true">
    <div class="modal-dialog relative w-auto">
      <div class="modal-content rounded-lg" style="border:none">
        <div class="modal-header border-b px-4 py-3 flex items-center justify-between text-left text-slate-800">
          <h4 class="modal-title inline-flex items-center gap-3 dark:text-white"><i class="ti ti-folder"></i> <span id="ticket-title" class="font-bold"></span></h4>
        </div>
        <div class="modal-body px-4 py-3">
          
        </div>
        <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
          <button type="button" class="button button-tertiary" data-bs-dismiss="modal" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-times"></i> Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Formulir Pengaduan -->
  <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="newpengaduan" tabindex="-1" role="dialog" aria-labelledby="newpengaduan" aria-hidden="true">
    <div class="modal-dialog relative w-auto">
      <div class="modal-content rounded-lg" style="border:none">
        <div class="modal-header border-b dark:border-slate-800 px-4 py-3 flex items-center justify-between text-left text-slate-800">
          <h4 class="modal-title inline-flex items-center gap-3 font-heading font-bold dark:text-white"><i class="ti ti-pencil fa-2x"></i> Buat Pengaduan Baru</h4>
        </div>
        <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
          <div class="modal-body px-4 py-3">
            @include('theme::commons.notif')
            @php $data = 	session('data', []) @endphp
            <div class="py-2">
              <input name="nik" type="text" maxlength="16" class="form-input" placeholder="NIK" value="{{ $data['nik'] }}">
            </div>
            <div class="py-2">
              <input name="nama" type="text" class="form-input" placeholder="Nama*" value="{{ $data['nama'] }}" required>
            </div>
            <div class="py-2">
              <input name="email" type="email" class="form-input" placeholder="Email" value="{{ $data['email'] }}">
            </div>
            <div class="py-2">
              <input name="telepon" type="text" class="form-input" placeholder="Telepon" value="{{ $data['telepon'] }}">
            </div>
            <div class="py-2">
              <input name="judul" type="text" class="form-input" placeholder="Judul*" value="{{ $data['judul'] }}" required>
            </div>
            <div class="py-2">
              <textarea name="isi" class="form-textarea" placeholder="Isi Pengaduan*" rows="5" required>{{ $data['isi'] }}</textarea>
            </div>
            <div class="py-2">
              <div class="relative">
                <input type="text" accept="image/*" onchange="readURL(this);" class="form-input" id="file_path" placeholder="Unggah Foto" name="foto" value="{{ $data['foto'] }}">
                <input type="file" accept="image/*" onchange="readURL(this);" class="hidden" id="file" name="foto" value="{{ $data['foto'] }}">
                <span class="absolute top-1/2 right-0 transform -translate-y-1/2 mr-1">
                  <button type="button" class="button button-info button-flat" id="file_browser" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-search"></i></button>
                </span>
              </div>
              <small>Gambar: png,jpg,jpeg</small><br>
              <br><img loading="lazy" id="blah" src="#" alt="gambar pendukung di sini" class="max-w-full w-full hidden" />
            </div>
            <div class="flex">
              <div class="w-full lg:w-5/12 overflow-hidden">
                <img loading="lazy" id="captcha" src="{{ site_url('captcha') }}" alt="CAPTCHA Image" class="w-full lg:w-11/12">
                <button type="button" class="button button-transparent text-sm" data-mdb-ripple="true" data-md-ripple-color="light" onclick="document.getElementById('captcha').src = '{{ site_url("captcha") }}?' + Math.random()">[Ganti Gambar]</button>
              </div>
              <div class="w-full lg:w-7/12">
                <input type="text" class="form-input required" name="captcha_code" maxlength="6" value="{{ $notif['data']['captcha_code'] }}" placeholder="Isikan sesuai kode captcha" required>
              </div>
            </div>
          </div>
          <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-between p-4 border-t border-gray-200 dark:border-slate-800 rounded-b-md">
            <button type="button" class="button button-tertiary pull-left" data-bs-dismiss="modal" aria-hidden="true" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-times"></i> Tutup</button>
            <button type="submit" class="button button-secondary pull-right" data-mdb-ripple="true" data-md-ripple-color="light"><i class="ti ti-pencil"></i> Kirim</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('styles')
  <style>
  .label {
    border-radius: 4px;
    padding: 2px 8px;
    color: white;
  }
  .label-danger {
    background-color: #dc2626;
  }
  .label-info {
    background-color: #0891b2;
  }
  .label-success {
    background-color: #059669;
  }

  .support-content .fa-padding .fa {
    padding-top: 5px;
    width: 1.5em;
  }

  .support-content .info {
    color: #777;
    margin: 0px;
  }

  .support-content a {
    color: #111;
  }

  .support-content .info a:hover {
    text-decoration: underline;
  }

  .support-content .info .fa {
    width: 1.5em;
    text-align: center;
  }

  .support-content .number {
    color: #777;
  }

  .support-content img {
    margin: 0 auto;
    display: block;
  }

  .support-content .modal-body {
    padding-bottom: 0px;
  }

  .support-content-comment {
    padding: 10px 10px 10px 30px;
  }

  .italic {
    font-style:italic;
  }

  .items-end {
    align-items: flex-end;
  }
  </style>
@endpush
@push('scripts')
  <script>
    $('#file_browser').click(function(e)
    {
      e.preventDefault();
      $('#file').click();
    });
    $('#file').change(function()
    {
      $('#file_path').val($(this).val());
      if ($(this).val() == '')
      {
        $('#'+$(this).data('submit')).attr('disabled','disabled');
      }
      else
      {
        $('#'+$(this).data('submit')).removeAttr('disabled');
      }
    });
    $('#file_path').click(function()
    {
      $('#file_browser').click();
    });
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#blah').removeClass('hidden');
          $('#blah').attr('src', e.target.result).width(150).height(auto);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
    $(document).ready(function() {
      const pageSize = 2
      let pageNumber = 1
      let status = ''
      let cari = $('input[name=ticket-query]').val()
      
      var data = {{ count(session('data') ?? [])  }};
      if (data) {
        $('#newpengaduan').modal('show');
      }

      $("#search-form").submit(function(event) {
        event.preventDefault()
        pageNumber = 1
        cari = $('input[name=ticket-query]').val()
        status = $('#caristatus').val()
        loadPengaduan(pageNumber)
      })

      const loadPengaduan = function (pageNumber) {
        let _filter = []
        if(status){
          _filter.push('filter[status]='+status)  
        }
        if(cari){
          _filter.push('filter[search]='+cari)				
        }
        let _filterString = _filter.length ? _filter.join('&') : '' 			
        $.ajax({
          url: `{{ ci_route('internal_api.pengaduan') }}?sort=-created_at&page[number]=${pageNumber}&page[size]=${pageSize}&${_filterString}`,
          type: "GET",
          beforeSend: function(){
            const ticketList = document.getElementById('ticket-list');
            ticketList.innerHTML = '';
            $('#loading').html(`@include('theme::commons.loading')`);
          },
          dataType: 'json',
          data: {
            
          },
          success: function (data) {
            displayPengaduan(data);
            const pagination = initPagination(data)
          }
        });
      }

      const displayPengaduan = function (dataPengaduan) {
        const ticketList = document.getElementById('ticket-list');
        ticketList.innerHTML = '';
        $('#loading').empty();
        if(!dataPengaduan.data.length) {
          ticketList.innerHTML = `<div class="alert alert-info" role="alert">Data tidak tersedia</div>`
          return
        }
        dataPengaduan.data.forEach(item => {
          const card = document.createElement('div');
          const labelComment = `<span class="label label-`+ (item.attributes.child_count ? 'success' : 'danger')+ ` pull-right text-xs flex-shrink-0"><i class="fa fa-comments"></i> ${item.attributes.child_count} Tanggapan</span>`
          const isi = `<span class="italic">${item.attributes.isi.substring(0,50)}`+ (item.attributes.isi.length > 50 ? `... <label class="underline">selengkapnya ></label>`: '') +`</span>`
          let labelStatus;
          switch(item.attributes.status){
            case 1:
              labelStatus = `<span class="label label-danger">Menunggu Diproses</span>`
              break;
            case 2:
              labelStatus = `<span class="label label-info">Sedang Diproses</span>`
              break;
            case 3:
              labelStatus = `<span class="label label-success">Selesai Diproses</span>`
              break;
          }
          card.className = `card p-5 border cursor-pointer`;				
          card.innerHTML = `										
            <dl>
              <dt class="font-bold lg:text-xl">${item.attributes.judul}</dt>
              <ul class="inline-flex flex-wrap gap-2 w-full items-center text-xs">
                <li class="inline-flex items-center"><i class="ti ti-calendar inline-block mr-1 text-secondary"></i>
                  ${item.attributes.created_at}</li>
                <li class="inline-flex items-center"><i class="ti ti-user inline-block mr-1 text-secondary"></i>
                  ${item.attributes.nama}</li>
                <li>${labelStatus}</li>
              </ul>
              <dd class="pt-2 flex flex-col lg:flex-row items-end justify-between gap-3">
                ${isi}
                ${labelComment}
              </dd>
            </dl>
          `;
          card.onclick = function(){
            let _comments = []
            const image  = item.attributes.foto ? `<img class="w-auto max-w-full" src="${item.attributes.foto}">` : ``
            if(item.attributes.child_count){
              item.attributes.child.forEach(comment => {

                _comments.push(`<div class="alert alert-info text-green-600">
                    <p class="text-xs lg:text-sm">Ditanggapi oleh ${comment.nama} | ${comment.created_at}</p>
                    <p class="italic">${comment.isi}</p>
                  </div>`)		
              });
            }
            const htmlBody = `
              <div class="w-full py-2 space-y-2">
                <p class="text-muted text-xs lg:text-sm">Pengaduan oleh ${item.attributes.nama} | ${item.attributes.created_at}</p>
                <p class="italic">${item.attributes.isi}</p>
                ${image}													
              </div>
              ${_comments.join('')}`;
                      
            $('#ticket-detail').modal('show')
            $('#ticket-title').text(item.attributes.judul)
            $('#ticket-detail .modal-body').html(htmlBody)					
          }				
          ticketList.appendChild(card);
        });
      }		

      loadPengaduan(pageNumber);
    });
    $('#pagination-container').on('click', '.pagination-link', function () {
      var params = {};
      var page = $(this).data("page");

      params["page[number]"] = page;

      loadPengaduan(params);
    });
  </script>
@endpush