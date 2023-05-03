@can('schedules.edit')
  <a href="{{ route('schedules.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil-alt"></i></a>
@endcan
@can('schedules.show')
  <a href="#" onclick="detailSchedule(`{{ route('schedules.show', $uuid) }}`)" class="text-info me-2"><i class="fa fa-sm fa-eye"></i></a>
@endcan
@can('schedules.destroy')
  <a href="#" onclick="deleteSchedule(`{{ route('schedules.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
@endcan