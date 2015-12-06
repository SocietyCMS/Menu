<?php

namespace Modules\Menu\Repositories\Menu;

use Illuminate\Config\Repository;
use Illuminate\Support\Str;
use Pingpong\Menus\MenuBuilder;
use Pingpong\Menus\MenuItem;

/**
 * Class MenuRepository
 * @package Modules\Menu\Repositories\Menu
 */
class MenuRepository
{

    /**
     * All of the menu items.
     *
     * @var array
     */
    protected $menus = [];

    /**
     * The constructor.
     *
     * @param Factory $views
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }


    /**
     * Create MenuItem for specified menu
     * @param $name
     * @return MenuItem
     */
    public function menu($name)
    {
        if (array_key_exists($name, $this->menus)) {
            return $this->menus[$name];
        }

        return $this->menus[$name] = new MenuBuilder($name, $this->config);
    }

    /**
     * Create MenuItem for Main Menu
     *
     * @return MenuItem
     */
    public function mainMenu()
    {
        return $this->menu('main');
    }

    /**
     * Get all of the menus
     *
     * @return array
     */
    public function menus()
    {
        return $this->menus;
    }

    /**
     * Generate Item uuid
     *
     * @param $menuName
     * @param $itemURL
     * @return string
     */
    public function getItemUuiD($menuItem)
    {
        $itemID = '';
        if(is_a($menuItem, MenuItem::class)){
            $itemID = "MenuItem".$menuItem->getURL();
        }

        if(is_a($menuItem, MenuBuilder::class)){
            $itemID = "MenuBuilder".$menuItem->getName();
        }

        return Str::limit(md5(Str::slug($itemID)), 12, null);
    }
}
