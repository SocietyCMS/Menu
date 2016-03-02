<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;
use Baum\Node;

class Menulink extends Node
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu__menulinks';

    /**
     * The fillable properties of the model.
     *
     * @var array
     */
    protected $fillable = ['title', 'target', 'menu_id', 'parent_id', 'lft', 'rgt', 'depth'];

    /**
     * Column to perform the default sorting
     *
     * @var string
     */
    protected $orderColumn = 'title';

    /**
     * Get the menu that owns the link.
     */
    public function menu()
    {
        return $this->belongsTo('Modules\Menu\Entities\Menu');
    }

}
