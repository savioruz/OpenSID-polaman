
@php $action_link = $form_action ?? site_url('layanan-mandiri/cek') @endphp

<form  action="{{ $action_link }}" method="post" class="shadow rounded-lg bg-primary dark:bg-dark-secondary overflow-hidden relative">
  <h3 class="py-4 text-center bg-secondary text-white font-bold font-heading text-lg absolute top-0 left-0 w-full">Layanan Mandiri</h3>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1040 320" class="mt-4">
    <path class="fill-current text-secondary" d="M0,192L60,176C120,160,240,128,360,133.3C480,139,600,181,720,186.7C840,192,960,160,1080,154.7C1200,149,1320,171,1380,181.3L1440,192L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
    </path>
  </svg>
  <div class="p-5 -mt-10 space-y-4 pb-8">
    <div class="bg-slate-200 dark:bg-dark-primary py-2 px-4 border-l-4 border-secondary text-secondary">
      <p class="text-xs"><i class="ti ti-info-circle mr-1"></i> Hubungi operator {{ setting('sebutan_desa') }} untuk memperoleh PIN</p>
    </div>
    <div class="space-y-2 flex flex-col">
      <label for="nik" class="text-white text-sm font-bold">NIK / No. KTP</label>
      <input type="text" class="form-input" id="nik" name="nik">
    </div>
    <div class="space-y-2 flex flex-col">
      <label for="pin" class="text-white text-sm font-bold">Kode PIN</label>
      <input type="password" class="form-input" id="pin" name="pin">
    </div>
    <button type="submit" class="button button-tertiary w-full mt-10 hover:ring-offset-primary" data-mdb-ripple="true" data-md-ripple-color="light">Masuk</button>
  </div>
</form>
