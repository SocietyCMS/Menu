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
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        $menu = Menu::defaultOrder()->get()->toTree();

        return $this->response()->collection($menu, new MenuTransformer());
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $menu = Menu::create($request->input());
        return $this->response()->item($menu, new MenuTransformer());
    }
}
