@can('registrations.show')
  <a href="{{ route('registrations.show', $uuid) }}" class="text-info me-2"><i class="fa fa-sm fa-eye"></i></a>
@endcan
@can('registrations.destroy')
  @if($status !== Constant::APPROVED)
    <a href="#" onclick="deleteRegistration(`{{ route('registrations.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
  @endif
@endcan