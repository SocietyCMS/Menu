<?php

namespace Modules\Menu\Repositories;

/**
 * Interface MenuExtender
 * @package Modules\Menu\Repositories
 */
interface MenuItem
{
    /**
     * @return mixed
     */
    public function getNameForMenuItem();

    /**
     * @return mixed
     */
    public function getRouteForMenuItem();
}
