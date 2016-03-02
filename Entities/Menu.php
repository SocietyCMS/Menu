<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
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
    protected $fillable = ['title'];

    /**
     * Get the items for the menu.
     */
    public function links()
    {
        return $this->hasMany('Modules\Menu\Entities\Menulink');
    }
}
