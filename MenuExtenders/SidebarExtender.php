<?php

namespace Modules\Menu\MenuExtenders;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Contracts\Authentication;

class SidebarExtender implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->weight(10);

            $group->item(trans('menu::module.title'), function (Item $item) {
                $item->weight(20);
                $item->icon('fa fa-bars');
                $item->route('backend::menu.menu.index');
                $item->authorize(
                    $this->auth->can('menu::manage-menu')
                );
            });
        });

        return $menu;
    }
}
