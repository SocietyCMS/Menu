<?php

namespace Modules\Menu\Repositories\Menu;

use Illuminate\Container\Container;
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


    private $extenders;

    /**
     * MenuBuilder constructor.
     * @param RepositoryInterface $modules
     * @param Container $container
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
    public function get()
    {

        foreach ($this->modules->enabled() as $module) {
            $name = studly_case($module->getName());
            $class = 'Modules\\' . $name . '\\MenuExtenders\\MenuExtender';

            if (class_exists($class)) {
                $extender = $this->container->make($class);
                $this->extenders->put($module->getName(), $extender->contentItems());
            }
        }

        return $this->extenders;

    }
}
