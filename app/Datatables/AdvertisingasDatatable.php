<?php

namespace App\Datatables;

use App\Models\AdAs;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;
use Illuminate\Support\Str;

class AdvertisingasDatatable extends Datatable
{
    public $slug = 'advertisingas';

    public function datasource()
    {
        return AdAs::query();
    }

    public function setUp()
    {
        $this->order('id', 'desc')
        ->setRowId('id')
        ->buttons('filters', 'print', 'excel',  'csv', 'refresh')
        ->pageLength(20)
        ->condensed()
        ->stateSave();
    }

    public function columns(): array
    {
        return [
            Column::add(__('Id'))
                ->data('id'),

                Column::add(__('তারিখ'))
                ->data('created_at')
                ->dateFormat(__("D/M/Y")),

            Column::add(__('বিবরণ / আদেশ'))
                ->data('details'),

            Column::add(__('বিষয়'))
                ->data('subject'),

            Column::add(__('ছাপার তারিখ'))
                ->data('published_date')
                ->dateFormat(__("D/M/Y")),

            Column::add(__('টাকা'))
                ->data('amount'),

            Column::add(__('সাইজ'))
                ->data('size'),

            Column::add(__('পৃষ্ঠা'))
                ->data('page'),

            Column::add(__('আ/স'))
                ->data('as'),

            Column::add(__('মন্তব্য'))
                ->data('comment', function (AdAs $adas) {
                    return Str::limit($adas->comment, 50);
                }),

            

           /* Column::add(__('Updated At'))
                ->data('updated_at'),

            */

            Column::add()
                ->width('20px')
                ->actions(function (AdAs $adas) {
                    return join([
                         Button::show('backend.ads.as.show', $adas),
                         Button::edit('backend.ads.as.edit', $adas),
                         Button::delete('backend.ads.as.destroy', $adas),
                    ]);
                }),
        ];
    }
}
