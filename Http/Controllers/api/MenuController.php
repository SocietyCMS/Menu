<?php

namespace Modules\Menu\Http\Controllers\api;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\ApiBaseController;
use Modules\Menu\Repositories\Eloquent\EloquentMenuRepository;
use Modules\Menu\Repositories\MenuBuilder;

class MenuController extends ApiBaseController
{
    /**
     * @var MenuRepository
     */
    protected $menu;

    /**
     * @var EloquentMenuRepository
     */
    protected $eloquentMenuModel;

    public function __construct(MenuBuilder $menu, EloquentMenuRepository $eloquentMenuModel)
    {
        parent::__construct();
        $this->menu              = $menu;
        $this->eloquentMenuModel = $eloquentMenuModel;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        foreach ($request->order as $order => $uuid) {
            $this->eloquentMenuModel->createOrUpdate(
                ['uuid' => $uuid],
                ['order' => $order + 100]
            );
        }

        return $this->successUpdated();
    }
}
