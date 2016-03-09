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

            'url' => $menu->url,

            'target' => $menu->target,
            'active' => (bool) $menu->active,

            'useSubject' => (bool) $menu->useSubject,

            'children' => $this->transformChildren($menu),
        ];
    }

    private function transformChildren(Menu $menu)
    {
        return $menu->children->map(function ($item, $key) {
            return $this->transform($item);
        });
    }
}
