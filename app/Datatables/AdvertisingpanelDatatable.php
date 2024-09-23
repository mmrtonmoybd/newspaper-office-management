<?php

namespace App\Datatables;

use App\Models\AdvertismentPanel;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;

class AdvertisingpanelDatatable extends Datatable
{
    public $slug = 'advertisingpanel';

    public function datasource()
    {
        return AdvertismentPanel::query();
    }

    public function setUp()
    {
        $this->order('id', 'desc')
            ->setRowId('id')
            ->permissions('ads_panel')
            ->buttons('filters', 'print', 'excel', 'csv', 'refresh')
            ->pageLength(20)
            ->condensed()
            ->stateSave();
    }

    public function columns(): array
    {
        return [
            Column::add(__('Id'))
                ->data('id'),

            Column::add(__('প্রতিষ্ঠানের নাম'))
                ->data('org_name'),

            Column::add(__('বিজ্ঞাপন শুরু'))
                ->data('advertisment_start_date')
                ->dateFormat(__('D/M/Y')),

            Column::add(__('বিজ্ঞাপন শেষ'))
                ->data('advertisment_end_date')
                ->dateFormat(__('D/M/Y')),

            Column::add(__('টাকা'))
                ->data('amount'),

            Column::add(__('প্ররিশোদের তারিখ'))
                ->data('paid_date')
                ->dateFormat(__('D/M/Y')),

            Column::add(__('মন্তব্য'))
                ->data('comment', function (AdvertismentPanel $advertismentpanel) {
                    return Str::limit($advertismentpanel->comment, 50);
                }),

            Column::add(__('তারিখ'))
                ->data('date')
                ->dateFormat(__('D/M/Y')),

            /* Column::add(__('Updated At'))
                ->data('updated_at'),
                */

            Column::add()
                ->width('20px')
                ->actions(function (AdvertismentPanel $advertismentpanel) {
                    return implode([
                        Button::show('backend.ads.panel.show', $advertismentpanel),
                        (Gate::allows('update', [$advertismentpanel->created_at, 'update_ads_panel'])) ? Button::edit('backend.ads.panel.edit', $advertismentpanel) : null,
                        (Gate::allows('delete', [$advertismentpanel->created_at, 'delete_ads_panel'])) ? Button::delete('backend.ads.panel.destroy', $advertismentpanel) : null,
                    ]);
                }),
        ];
    }
}
