<?php

namespace App\DataTables\Master;

use App\Helpers\Global\Constant;
use App\Models\Registration;
use App\Helpers\Global\Helper;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use App\Services\Registration\RegistrationService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class RegistrationDataTable extends DataTable
{
  /**
   * Create a new datatable instance.
   *
   * @return void
   */
  public function __construct(
    protected RegistrationService $registrationService,
  ) {
    // 
  }

  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      ->addIndexColumn()
      ->addColumn('user_name', fn ($row) => $row->user->name)
      ->editColumn('status', fn ($row) => $row->isStatus())
      ->editColumn('created_at', fn ($row) => Helper::customDate($row->created_at))
      ->addColumn('action', 'registrations.action')
      ->rawColumns(['action', 'status']);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Registration $model): QueryBuilder
  {
    if (isRoleName() === Constant::DONOR) {
      return $this->registrationService->getByUserId();
    } else {
      return $model->newQuery();
    }
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('registration-table')
      ->columns($this->getColumns())
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
      Column::make('number')
        ->title(trans('No. Pendaftaran'))
        ->addClass('text-center'),
      Column::make('user_name')
        ->title(trans('Nama Pendaftar'))
        ->addClass('text-center'),
      Column::make('status')
        ->title(trans('Status'))
        ->addClass('text-center'),
      Column::make('created_at')
        ->title(trans('Tanggal Daftar'))
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
    return 'Registration_' . date('YmdHis');
  }
}
