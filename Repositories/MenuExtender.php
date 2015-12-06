<?php

namespace Modules\Menu\Repositories;

use Modules\Menu\Repositories\Menu\MenuRepository;

interface MenuExtender
{
    /**
     * @param MenuRepository $menuItems
     *
     */
    public function extendWith(MenuRepository $menuItems);
}