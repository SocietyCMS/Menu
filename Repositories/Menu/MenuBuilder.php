<?php

namespace Modules\Menu\Repositories\Menu;

use Illuminate\Container\Container;
use Illuminate\Support\Str;
use Lavary\Menu\Facade as LavaryMenu;
use Modules\Menu\Entities\Menu;
use Pingpong\Modules\Contracts\RepositoryInterface;

/**
 * Class MenuBuilder.
 */
class MenuBuilder
{
    /**
     * @var RepositoryInterface
     */
    private $modules;
    /**
     * @var Container
     */
    private $container;

    /**
     * @var \Illuminate\Support\Collection
     */
    private $extenders;

    /**
     * MenuBuilder constructor.
     *
     * @param RepositoryInterface $modules
     * @param Container           $container
     *
     * @internal param RepositoryInterface $menus
     */
    public function __construct(RepositoryInterface $modules, Container $container)
    {
        $this->modules = $modules;
        $this->container = $container;

        $this->extenders = collect();
    }

    /**
     * Build the menu structure.
     *
     * @return mixed
     */
    public function getItemProviders()
    {
        foreach ($this->modules->enabled() as $module) {
            $name = studly_case($module->getName());
            $class = 'Modules\\'.$name.'\\MenuExtenders\\MenuExtender';

            if (class_exists($class)) {
                $extender = $this->container->make($class);
                $this->extenders->put($module->getName(), [
                    'content' => $extender->getContentItems(),
                    'static'  => $extender->getStaticItems(),
                ]);
            }
        }

        return $this->extenders;
    }

    /**
     * Build all Menus.
     */
    public function buildMenus()
    {
        $menu = Menu::whereIsRoot()->get();
        foreach ($menu as $item) {
            LavaryMenu::make(Str::slug($item->name), function ($menu) use ($item) {
                $this->buildMenuItems($menu, $item);
            });
        }
    }

    /**
     * @param $menu
     * @param $item
     */
    private function buildMenuItems($menu, $item)
    {
        $menuItems = $item->children()->defaultOrder()->where('active', true)->get();

        foreach ($menuItems as $item) {
            if ($item->useSubject) {
                $menuItem = $this->buildSubjectItem($menu, $item);
            } else {
                $menuItem = $this->buildStaticItem($menu, $item);
            }
            $this->addMenuItemProperties($menuItem, $item);
        }
    }

    /**
     * @param $menu
     * @param $item
     *
     * @return mixed
     */
    private function buildSubjectItem($menu, $item)
    {
        if (! empty($item->subject_type) && ! is_null($item->subject)) {
            return $menu->add($item->name, ['url' => $item->subject->getRouteForMenuItem()]);
        }

        return false;
    }

    /**
     * @param $menu
     * @param $item
     *
     * @return mixed
     */
    private function buildStaticItem($menu, $item)
    {
        return $menu->add($item->name, ['url' => $item->url]);
    }

    /**
     * @param $menuItem
     * @param $item
     */
    private function addMenuItemProperties($menuItem, $item)
    {
        if ($item->attribute_target) {
            $menuItem->link->attr('target', $item->attribute_target);
        }
        if ($item->attribute_id_attribute) {
            $menuItem->attr('id', $item->attribute_id);
        }
        if ($item->attribute_class) {
            $menuItem->attr('class', $item->attribute_class);
        }

        return $menuItem;
    }
}
