<?php

namespace App\DataTables\Master;

use App\Models\Schedule;
use App\Helpers\Global\Helper;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ScheduleDataTable extends DataTable
{
  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      ->addIndexColumn()
      ->addColumn('date', fn ($row) => Helper::customDate($row->date))
      ->addColumn('registration', fn ($row) => $row->registration->number)
      ->addColumn('user_name', fn ($row) => $row->registration->user->name)
      ->editColumn('status', fn ($row) => $row->isStatus())
      ->addColumn('action', 'schedules.action')
      ->rawColumns([
        'status',
        'action'
      ]);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Schedule $model): QueryBuilder
  {
    return $model->newQuery();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('schedule-table')
      ->columns($this->getColumns())
      ->ajax([
        'url' => route('schedules.index'),
        'type' => 'GET',
        'data' => "
          function(data) {
            _token = '{{ csrf_token() }}',
            data.status = $('select[name=status]').val();
          }"
      ])
      ->addTableClass([
        'table',
        'table-striped',
        'table-bordered',
        'table-hover',
        'table-vcenter',
      ])
      ->processing(true)
      ->retrieve(true)
      ->serverSide(true)
      ->autoWidth(false)
      ->pageLength(5)
      ->responsive(true)
      ->lengthMenu([5, 10, 20])
      ->orderBy(1);
  }

  /**
   * Get the dataTable columns definition.
   */
  public function getColumns(): array
  {
    return [
      Column::make('DT_RowIndex')
        ->title(trans('#'))
        ->orderable(false)
        ->searchable(false)
        ->width('10%')
        ->addClass('text-center'),
      Column::make('registration')
        ->title(trans('No. Pendaftaran'))
        ->addClass('text-center'),
      Column::make('date')
        ->title(trans('Tanggal Pengambilan'))
        ->addClass('text-center'),
      Column::make('user_name')
        ->title(trans('Nama Pendonor'))
        ->addClass('text-center'),
      Column::make('status')
        ->title(trans('Status'))
        ->addClass('text-center'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width('15%')
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Schedule_' . date('YmdHis');
  }
}
