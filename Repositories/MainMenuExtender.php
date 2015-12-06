<?php

namespace Modules\Menu\Repositories;

use Pingpong\Menus\MenuBuilder;

interface MainMenuExtender
{
    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(MenuBuilder $menu);
}
