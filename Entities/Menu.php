<?php

namespace Modules\Menu\Entities;

use Kalnoy\Nestedset\Node;

class Menu extends Node
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu__menus';

    /**
     * The fillable properties of the model.
     *
     * @var array
     */
    protected $fillable = ['name', 'url', 'target', 'active',  'useSubject', 'menu_id', 'parent_id', 'lft', 'rgt', 'depth'];

    /**
     * Get the items for the menu.
     */
    public function links()
    {
        return $this->hasMany('Modules\Menu\Entities\Menulink');
    }

}
