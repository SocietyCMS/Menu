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

            'children' => $this->transformChildren($menu),
        ];
    }

    private function transformChildren(Menu $menu)
    {
        $transformer = new NodeTransformer();

        return $menu->children->map(function ($item, $key) use ($transformer) {
            return $transformer->transform($item);
        });
    }
}
