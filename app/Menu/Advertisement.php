<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;
use Sebastienheyd\Boilerplate\Menu\MenuItemInterface;

class Advertisement implements MenuItemInterface
{
    public function make(Builder $menu)
    {
        $item = $menu->add('Advertisement', [
            'permission' => 'an_permission|as_permission|ads_panel',
            'active'     => 'backend.ads.an.*|backend.ads.as.*|backend.ads.panel.*',
            'icon'       => 'fa-ad',
            'order'      => 100,
        ]);

        $item->add('A/N', [
            'permission' => 'an_permission',
            'active'     => 'backend.ads.an.*',
            'route'      => 'backend.ads.an.index',
        ]);

        $item->add('A/S', [
            'permission' => 'as_permission',
            'active'     => 'backend.ads.as.*',
            'route'      => 'backend.ads.as.index',
        ]);

        $item->add('Advertisment panel', [
            'permission' => 'ads_panel',
            'active'     => 'backend.ads.panel.*',
            'route'      => 'backend.ads.panel.index',
        ]);
    }
}
