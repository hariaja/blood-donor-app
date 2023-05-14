<div class="modal fade" id="modal-show-schdule" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
  <div class="modal-dialog modal-dialog-popin modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="block block-rounded block-transparent mb-0">
        <div class="block-header block-header-default">
          <h3 class="block-title">{{ trans('page.schedules.show') }}</h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
              <i class="fa fa-fw fa-times"></i>
            </button>
          </div>
        </div>
        <div class="block-content fs-sm">

          <div class="mb-4">
            <ul class="list-group push">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Nomor Pendaftaran') }}
                <span class="fw-semibold" id="number"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Terakhir Donor') }}
                <span class="fw-semibold" id="last-donor"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Donor Kembali') }}
                <span class="fw-semibold" id="return-donor"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Bersedia Donor Kapanpun?') }}
                <span class="fw-semibold" id="urgency"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Bersedia Donor Bulan Ramadhan?') }}
                <span class="fw-semibold" id="ramadan"></span>
              </li>
            </ul>
          </div>

          <div class="mb-4">
            <ul class="list-group push">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Tanggal') }}
                <span class="fw-semibold" id="take-date"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Jam') }}
                <span class="fw-semibold" id="take-time"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Lokasi') }}
                <span class="fw-semibold" id="location"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Status Kedatangan') }}
                <span class="fw-semibold" id="status"></span>
              </li>
            </ul>
          </div>

          <div class="mb-4">
            <ul class="list-group push">
              <li class="list-group-item text-center">
                {{ trans('Alamat Lengkap') }}
              </li>
              <li class="list-group-item text-center">
                <span class="fw-semibold" id="address"></span>
              </li>
            </ul>
          </div>

        </div>
        <div class="block-content block-content-full text-end bg-body">
          <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>