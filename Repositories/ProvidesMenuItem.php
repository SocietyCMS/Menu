<?php

namespace Modules\Menu\Repositories;

/**
 * Interface MenuExtender.
 */
trait ProvidesMenuItem
{
    /**
     * Returns the name for a menu item.
     *
     * @return mixed
     */
    public function getNameForMenuItem()
    {
        return $this->title;
    }

    /**
     * Returns the route for a menu item.
     *
     * @return mixed
     */
    abstract public function getRouteForMenuItem();
}
