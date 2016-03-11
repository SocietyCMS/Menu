<?php

namespace Modules\Menu\Http\Controllers\backend;

use Modules\Core\Http\Controllers\AdminBaseController;
use Modules\Menu\Repositories\Menu\MenuBuilder;

class MenuController extends AdminBaseController
{
    /**
     * @var MenuBuilder
     */
    private $menuBuilder;

    /**
     * MenuController constructor.
     * @param MenuBuilder $menuBuilder
     */
    public function __construct(MenuBuilder $menuBuilder)
    {
        $this->menuBuilder = $menuBuilder;
    }


    /**
     * @return mixed
     */
    public function index()
    {
        $extenders = $this->menuBuilder->getItemProviders();
        return view('menu::backend.index', compact('extenders'));
    }
}
