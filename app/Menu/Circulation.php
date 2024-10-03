<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;
use Sebastienheyd\Boilerplate\Menu\MenuItemInterface;

class Circulation implements MenuItemInterface
{
    public function make(Builder $menu)
    {
        $item = $menu->add('Circulation', [
            'permission' => 'representative_monthly_circulation|monthly_circulation|daily_circulation',
            'active'     => 'backend.monthly.*|backend.representative.*|backend.daily.*',
            'icon'       => 'fa-regular fa-sack-dollar',
            'order'      => 100,
        ]);

        $item->add('Monthly', [
            'permission' => 'monthly_circulation',
            'active'     => 'backend.monthly.*',
            'route'      => 'backend.monthly.index',
        ]);

        $item->add('Representative', [
            'permission' => 'representative_monthly_circulation',
            'active'     => 'backend.representative.*',
            'route'      => 'backend.representative.index',
        ]);

        $item->add('Daily', [
            'permission' => 'daily_circulation',
            'active'     => 'backend.daily.*',
            'route'      => 'backend.daily.index',
        ]);
    }
}
