<?php

namespace Modules\Menu\Http\Controllers\api;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\ApiBaseController;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Repositories\Eloquent\EloquentMenuRepository;
use Modules\Menu\Repositories\MenuBuilder;
use Modules\Menu\Transformers\MenuTransformer;
use Modules\Menu\Transformers\NodeTransformer;

class NodeController extends ApiBaseController
{

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $menuParentItem = Menu::whereIsRoot()->first();
        $menu = $menuParentItem->children()->create([
            'name' => trans('menu::menu.node.new item'),
            'active' => true
        ]);

        return $this->response()->item($menu, new NodeTransformer());
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function show(Request $request, $id)
    {
        $menuItem = Menu::where('id', $id)->first();
        return $this->response()->item($menuItem, new NodeTransformer());
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $node = Menu::where('id', $id)->first();

        $this->moveNode($request, $node);
        $this->updateNode($request, $node);

        return $this->response()->item($node, new NodeTransformer());
    }

    /**
     * @param Request $request
     * @param $node
     */
    protected function moveNode(Request $request, $node)
    {
        if(!$request->target_node) {
            return;
        }

        $target_node = Menu::where('id', $request->target_node)->first();

        if ($request->position == 'after') {
            $node->afterNode($target_node)->save();
        }

        if ($request->position == 'inside') {
            $before = $target_node->getDescendants()->first();

            $node->appendTo($target_node);

            if (! is_null($before)) {
                $node->beforeNode($before);
            }
            $node->save();
        }
    }

    protected function updateNode(Request $request, $node)
    {
        if($request->useSubject) {
            $subject = unserialize($request->subject);
            $node->subject_type = $subject['subject_type'];
            $node->subject_id = $subject['subject_id'];
        }
        $node->update($request->input());
    }
}
