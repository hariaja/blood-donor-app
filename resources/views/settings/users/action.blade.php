@canany(['users.edit', 'donors.edit'])
  @if ($model->hasRole(Constant::OFFICER))
    <a href="{{ route('users.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  @else
    <a href="{{ route('donors.edit', $model->donor->uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  @endif
@endcan
@can('users.destroy')
  <a href="#" onclick="deleteUser(`{{ route('users.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
@endcan