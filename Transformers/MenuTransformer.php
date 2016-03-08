<?php

namespace Modules\Menu\Transformers;

use League\Fractal;
use Modules\Gallery\Entities\Album;
use Modules\Menu\Entities\Menu;

class MenuTransformer extends Fractal\TransformerAbstract
{
    public function transform(Menu $menu)
    {
        return [
            'id'     => $menu->id,
            'name'   => $menu->name,
            'target' => $menu->target,

            'children' => $this->transformChildren($menu),
        ];
    }

    private function transformChildren(Menu $menu)
    {
        return $menu->children()->get()->map(function ($item, $key) {
            return $this->transform($item);
        });
    }
}
