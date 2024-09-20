<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;
use Sebastienheyd\Boilerplate\Menu\MenuItemInterface;

class Circulation implements MenuItemInterface
{
    public function make(Builder $menu)
    {
        $item = $menu->add('Circulation', [
            'permission' => 'backend',
            'active' => 'boilerplate.dashboard',
            'icon' => 'fa-regular fa-sack-dollar',
            'order' => 100,
        ]);

        $item->add('Monthly', [
            'permission' => 'backend',
            'active' => 'backend.monthly.*',
            'route' => 'backend.monthly.index',
        ]);

        $item->add('Representative', [
            'permission' => 'backend',
            'active' => 'backend.representative.*',
            'route' => 'backend.representative.index',
        ]);

    }
}
