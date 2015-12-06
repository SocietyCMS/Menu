<?php namespace Modules\Menu\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentMenuRepository extends EloquentBaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "Modules\\Menu\\Entities\\Menu";
    }

    public function get($id)
    {
        return $this->findWhere([
            'uuid' => $id
        ])->first();
    }
}
