<?php

namespace App\Datatables;

use App\Models\AdAn;
use Illuminate\Support\Str;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;

class AdvertisanDatatable extends Datatable
{
    public $slug = 'advertisan';

    public function datasource()
    {
        return AdAn::query();
    }

    public function setUp()
    {
        $this->order('id', 'desc')
            ->setRowId('id')
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

            Column::add(__('তারিখ'))
                ->data('created_at')
                ->dateFormat(__('D/M/Y')),

            Column::add(__('বিবরণ / আদেশ'))
                ->data('details'),

            Column::add(__('বিষয়'))
                ->data('subject'),

            Column::add(__('ছাপার তারিখ'))
                ->data('published_date')
                ->dateFormat(__('D/M/Y')),

            Column::add(__('টাকা'))
                ->data('amount'),

            Column::add(__('সাইজ'))
                ->data('size'),

            Column::add(__('পৃষ্ঠা'))
                ->data('page'),

            Column::add(__('আ/ন'))
                ->data('an'),

            Column::add(__('মন্তব্য'))
                ->data('comment', function (AdAn $adAn) {
                    return Str::limit($adAn->comment, 50);
                }),

            /* Column::add(__('Updated At'))
                ->data('updated_at'),

            */

            Column::add()
                ->width('20px')
                ->actions(function (AdAn $adan) {
                    return implode([
                        Button::show('backend.ads.an.show', $adan),
                        Button::edit('backend.ads.an.edit', $adan),
                        Button::delete('backend.ads.an.destroy', $adan),
                    ]);
                }),
        ];
    }
}
