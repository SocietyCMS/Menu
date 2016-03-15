<?php

namespace Modules\Menu\Repositories;

/**
 * Interface MenuExtender
 * @package Modules\Menu\Repositories
 */
abstract class BaseMenuExtender
{
    /**
     * @return mixed
     */
    abstract public function contentItems();
    /**
     * @return mixed
     */
    abstract public function staticLinks();

    public function getContentItems()
    {
        $collection = $this->contentItems()->map(function ($item, $key) {
            return [
                'name' => $item->getNameForMenuItem(),
                'subject_id' => $item->{$item->getKeyName()},
                'subject_type' => get_class($item),
                'subject' => serialize([ 'subject_id' => $item->{$item->getKeyName()},
                                         'subject_type' => get_class($item)])
            ];
        });

        return $collection;
    }

    public function getStaticItems()
    {
        return $this->staticLinks()?:collect();
    }
}
