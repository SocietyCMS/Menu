<?php

namespace Modules\Menu\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;

class EloquentMenuRepository extends EloquentBaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'Modules\\Menu\\Entities\\Menu';
    }

    public function get($id)
    {
        return $this->findWhere([
            'uuid' => $id,
        ])->first();
    }
}
