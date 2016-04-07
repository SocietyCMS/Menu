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
    protected $fillable = ['name', 'url', 'attribute_target', 'attribute_id', 'attribute_class', 'active', 'useSubject', 'lft', 'rgt', 'depth'];

    /**
     * Get all of the staff member's photos.
     */
    public function subject()
    {
        return $this->morphTo();
    }

}
