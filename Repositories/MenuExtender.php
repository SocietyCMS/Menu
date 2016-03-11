<?php

namespace Modules\Menu\Repositories;


use Modules\Menu\Repositories\Menu\MenuRepository;

/**
 * Interface MenuExtender
 * @package Modules\Menu\Repositories
 */
interface MenuExtender
{
    /**
     * @return mixed
     */
    public function contentItems();

    /**
     * @return mixed
     */
    public function staticLinks();
}
