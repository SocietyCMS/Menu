<?php

namespace Modules\Menu\Http\Controllers\backend;

use Modules\Core\Http\Controllers\AdminBaseController;
use Modules\Menu\Repositories\Menu\MenuBuilder;

class MenuController extends AdminBaseController
{

    /**
     * @return mixed
     */
    public function index()
    {
        $extender = app(MenuBuilder::class);
        $extenders = $extender->get();
        return view('menu::backend.index', compact('extenders'));
    }
}
