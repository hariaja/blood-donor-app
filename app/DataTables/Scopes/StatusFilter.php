<?php

namespace App\DataTables\Scopes;

use Illuminate\Http\Request;
use App\Helpers\Global\Constant;
use Yajra\DataTables\Contracts\DataTableScope;

class StatusFilter implements DataTableScope
{
  public function __construct(protected Request $request)
  {
    # code...
  }

  /**
   * Apply a query scope.
   *
   * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
   * @return mixed
   */
  public function apply($query)
  {
    $filters = ['status'];

    foreach ($filters as $field) :
      if ($this->request->has($field)) :
        if ($this->request->get($field) !== null) :
          if ($this->request->get($field) === Constant::ALL) :
          // 
          else :
            $query->where($field, $this->request->get($field));
          endif;
        endif;
      endif;
    endforeach;

    return $query;
  }
}
