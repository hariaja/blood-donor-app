@extends('layouts.app')
@section('title') {{ trans('page.registrations.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.registrations.title') }}</h1>
    </div>
  </div>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.registrations.index') }}
      </h3>
      <div class="block-options">
        @if(me()->hasRole(Constant::DONOR))
          @can('registrations.create')
            <a href="{{ route('registrations.create') }}" class="btn btn-sm btn-primary">
              <i class="fa fa-plus fa-xs me-1"></i>
              {{ trans('page.button.create') }}
            </a>
          @endcan
        @endif
      </div>
    </div>
    <div class="block-content">

      <div class="row">
        <div class="col-md-4">
          <div class="mb-4">
            <label for="status" class="form-label">{{ trans('Filter Status') }}</label>
            <select type="text" class="form-select" name="status" id="status">
              <option value="{{ Constant::ALL }}">{{ Constant::ALL }}</option>
              <option value="{{ Constant::PENDING }}">{{ Constant::PENDING }}</option>
              <option value="{{ Constant::APPROVED }}">{{ Constant::APPROVED }}</option>
              <option value="{{ Constant::REJECTED }}">{{ Constant::REJECTED }}</option>
            </select>
          </div>
        </div>
      </div>

      <div class="my-3">
        {{ $dataTable->table() }}
      </div>

    </div>
  </div>
@endsection
@push('javascript')
  {{ $dataTable->scripts() }}

  <script>
    let table

    $(function () {
      table = $('.table').DataTable()

      $('#status').on('change', function (e) {
        table.draw()
        e.preventDefault()
      })
    })

    function deleteRegistration(url) {
      Swal.fire({
        icon: 'warning',
        title: 'Apakah Anda Yakin?',
        html: 'Dengan menekan tombol hapus, Maka <b>Semua Data</b> akan hilang!',
        showCancelButton: true,
        confirmButtonText: 'Hapus Data',
        cancelButtonText: 'Batalkan',
        cancelButtonColor: '#E74C3C',
        confirmButtonColor: '#3498DB'
      }).then((result) => {
        if (result.value) {
          $.post(url, {
            '_token': $('[name=csrf-token]').attr('content'),
            '_method': 'delete'
          })
          .done((response) => {
            Swal.fire({
              icon: 'success',
              title: response.message,
              confirmButtonText: 'Selesai'
            })
            table.ajax.reload()
          })
          .fail((errors) => {
            Swal.fire({
              icon: 'error',
              title: errors.responseJSON.message,
              confirmButtonText: 'Mengerti'
            })
            return
          })
        } else if (result.dismiss == swal.DismissReason.cancel) {
          Swal.fire({
            icon: 'error',
            title: 'Tidak ada perubahan disimpan',
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#3498DB'
          })
        }
      })
    }
  </script>
@endpush