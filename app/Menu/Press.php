<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;
use Sebastienheyd\Boilerplate\Menu\MenuItemInterface;

class Press implements MenuItemInterface
{
    public function make(Builder $menu)
    {
        $item = $menu->add('Press', [
            'permission' => 'press_paper|press_ink|press_plate',
            'active' => 'backend.paper.*',
            'icon' => 'fa-newspaper',
            'order' => 300,
        ]);

        $item->add('Ink', [
            'permission' => 'press_ink',
            'active' => 'backend.ink.*',
            'route' => 'backend.ink.index',
        ]);

        $item->add('Paper', [
            'permission' => 'press_paper',
            'active' => 'backend.paper.*',
            'route' => 'backend.paper.index',
        ]);

        $item->add('Plate', [
            'permission' => 'press_plate',
            'active' => 'backend.plate.*',
            'route' => 'backend.plate.index',
        ]);

    }
}
