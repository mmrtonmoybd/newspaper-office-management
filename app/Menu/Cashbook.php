<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;
use Sebastienheyd\Boilerplate\Menu\MenuItemInterface;

class Cashbook implements MenuItemInterface
{
    public function make(Builder $menu)
    {
        $item = $menu->add('Cashbook management', [
            'permission' => 'backend',
            'active' => 'backend.calculations.*|backend.cashbook.categories.*',
            'icon' => 'square',
            'order' => 100,
        ]);

        $item->add('Cashbook', [
            'permission' => 'cashbook',
            'active' => 'backend.calculations.*',
            'route' => 'backend.calculations.index',
        ]);

        $item->add('Entries heading', [
            'permission' => 'cashbook_entry_heading',
            'active' => 'backend.categories.*',
            'route' => 'backend.categories.index',
        ]);
    }
}
