<?php

namespace Nht\Hocs\Entrusts;

use Nht\Hocs\Core\BaseRepository;
use Nht\Hocs\Entrusts\Permission;

/**
 * Class description.
 *
 * @author	AlvinTran
 */
class DbPermissionRepository extends BaseRepository implements PermissionRepository
{
	protected $model;

	public function __construct(Permission $model)
	{
		$this->model = $model;
	}

    public function getAllWithPaginate($filter = [], $pageSize = 20)
    {
        $query = $this->model->whereRaw(1);

        if ( ! empty($filter))
        {
            foreach ($filter as $key => $value)
            {
                if ($value == '')
                {
                    unset($filter[$key]);
                }
            }

            $query->where($filter);
        }

        return $query->orderBy('name', 'ASC')->paginate($pageSize);
    }

}