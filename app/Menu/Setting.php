<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;
use Sebastienheyd\Boilerplate\Menu\MenuItemInterface;

class Setting implements MenuItemInterface
{
    public function make(Builder $menu)
    {
        $menu->add('Setting', [
            'route'      => 'backend.settings.index',
            'active'     => 'backend.settings.index',
            'permission' => 'settings',
            'icon'       => 'fa-regular fa-gear',
            'order'      => 10000,
        ]);
    }
}
