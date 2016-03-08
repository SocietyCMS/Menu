<?php

namespace Modules\Menu\Http\Controllers\api;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\ApiBaseController;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Repositories\Eloquent\EloquentMenuRepository;
use Modules\Menu\Repositories\MenuBuilder;
use Modules\Menu\Transformers\MenuTransformer;

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
    public function index(Request $request)
    {
        $menu = Menu::roots()->get()->each(function ($item, $key) {
            return $item->getDescendantsAndSelf();
        });

        return $this->response()->collection($menu, new MenuTransformer());
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        Menu::buildTree(json_decode($request->tree, true));
        return $this->successUpdated();
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function show(Request $request, $id)
    {
        $menuItem = Menu::where('id', $id)->first();
        return $this->response()->item($menuItem, new MenuTransformer());
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $menuItem = Menu::where('id', $id)->first();
        $menuItem->update($request->input());
        return $this->response()->item($menuItem, new MenuTransformer());
    }
}
