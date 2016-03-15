<?php

namespace Modules\Menu\Transformers;

use League\Fractal;
use Modules\Gallery\Entities\Album;
use Modules\Menu\Entities\Menu;

class NodeTransformer extends Fractal\TransformerAbstract
{
    public function transform(Menu $menu)
    {
        return [
            'id'     => $menu->id,
            'name'   => $menu->name,

            'url' => $menu->url,

            'attribute_target' => $menu->attribute_target,
            'attribute_id' => $menu->attribute_id,
            'attribute_class' => $menu->attribute_class,

            'active' => (bool) $menu->active,

            'subject' => $this->transformSubject($menu),
            'useSubject' => (bool) $menu->useSubject,

            'parent' => $menu->parent_id,
            'children' => $this->transformChildren($menu),
        ];
    }

    private function transformChildren(Menu $menu)
    {
        return $menu->children->map(function ($item, $key) {
            return $this->transform($item);
        });
    }

    private function transformSubject(Menu $menu) {
        return serialize([
            'subject_id' => $menu->subject_id,
            'subject_type' => $menu->subject_type
        ]);
    }

}
