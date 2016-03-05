<?php

namespace Modules\Menu\Http\Controllers\backend;

use Modules\Core\Http\Controllers\AdminBaseController;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\Menulink;

class MenuController extends AdminBaseController
{

    public function index()
    {
        return view('menu::backend.index');
    }

    public function show($id)
    {
        $menu = Menu::roots()->where('menu_id' , $id)->first()->getDescendantsAndSelf()->toHierarchy();
        return view('menu::backend.show', compact('menu'));
    }
}
