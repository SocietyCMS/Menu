<?php

namespace Modules\Menu\Http\Controllers\backend;

use Modules\Core\Http\Controllers\AdminBaseController;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Repositories\Menu\MenuRepository;
use Modules\Menu\Repositories\MenuBuilder;

class MenuController extends AdminBaseController
{
    /**
     * @var MenuRepository
     */
    protected $menu;

    public function __construct(MenuBuilder $menu)
    {
        parent::__construct();
        $this->menu = $menu;
    }

    public function index()
    {
        $menus = $this->menu->getStructuredMenu();

        return view('menu::backend.index', compact('menus'));
    }
}
