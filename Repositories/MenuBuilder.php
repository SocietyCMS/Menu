<?php

namespace Modules\Menu\Repositories;

use Menu;
use Modules\Menu\Repositories\Eloquent\EloquentMenuRepository;
use Modules\Menu\Repositories\Menu\MenuRepository;

/**
 * Class MenuBuilder.
 */
class MenuBuilder
{
    /**
     * @var MenuRepository
     */
    protected $menuRepository;

    /**
     * @var EloquentMenuRepository
     */
    protected $eloquentMenuModel;

    /**
     * MenuBuilder constructor.
     *
     * @param MenuRepository $menuRepository
     * @param Menu           $eloquentMenuModel
     */
    public function __construct(MenuRepository $menuRepository, EloquentMenuRepository $eloquentMenuModel)
    {
        $this->menuRepository = $menuRepository;
        $this->eloquentMenuModel = $eloquentMenuModel;
    }

    /**
     * Build the menu structure.
     *
     * @return mixed
     */
    public function build()
    {
        foreach ($this->menuRepository->menus() as $menu) {
            $menuItems = $this->addEloquentProperties($menu);
            $menuItems = $this->orderMenuItems($menuItems);

            Menu::create($menu->getName(), function ($builder) use ($menuItems) {
                foreach ($menuItems as $item) {
                    $builder->add($item->getProperties());
                }
            });
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getStructuredMenu()
    {
        $menuCollection = collect();

        foreach ($this->menuRepository->menus() as $menu) {
            $menuItems = $this->addEloquentProperties($menu);
            $menuItems = $this->orderMenuItems($menuItems);

            $menuCollection->put($menu->getName(), $menuItems);
        }

        return $menuCollection;
    }

    /**
     * @param $menu
     * @return mixed
     */
    public function addEloquentProperties($menu)
    {
        $menuItems = $menu->toCollection()->each(function ($item, $key) {
            $itemID = $this->menuRepository->getItemUuiD($item);
            $item->uuid = $itemID;

            if ($eloquentItem = $this->eloquentMenuModel->get($itemID)) {
                if ($eloquentItem->order) {
                    $item->order($eloquentItem->order);
                    $item->order = $eloquentItem->order;
                }
            }
        });

        return $menuItems;
    }

    /**
     * @param $menuItems
     * @return mixed
     */
    public function orderMenuItems($menuItems)
    {
        return $menuItems->sortBy('order')->values()->all();
    }
}
