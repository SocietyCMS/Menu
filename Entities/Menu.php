<?php

namespace Modules\Menu\Entities;

use Baum\SetMapper;
use Illuminate\Database\Eloquent\Model;
use Baum\Node;

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
    protected $fillable = ['name', 'target', 'menu_id', 'parent_id', 'lft', 'rgt', 'depth'];

    /**
     * Get the items for the menu.
     */
    public function links()
    {
        return $this->hasMany('Modules\Menu\Entities\Menulink');
    }

    /**
     * Maps the provided tree structure into the database using the current node
     * as the parent. The provided tree structure will be inserted/updated as the
     * descendancy subtree of the current node instance.
     *
     * @param   array|\Illuminate\Support\Contracts\ArrayableInterface
     * @return  boolean
     */
    public function makeTree($nodeList) {
        $mapper = new SetMapper($this);

        return $mapper->mapTree($nodeList);
    }
}
