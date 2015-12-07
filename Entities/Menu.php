<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu_menu';
    /**
     * The fillable properties of the model.
     *
     * @var array
     */
    protected $fillable = ['id', 'uuid', 'order', 'title', 'show'];
}
