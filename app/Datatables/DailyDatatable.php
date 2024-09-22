<?php

namespace App\Datatables;

use App\Models\DailyCirculation;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;

class DailyDatatable extends Datatable
{
    public $slug = 'daily';

    public function datasource()
    {
        return DailyCirculation::query();
    }

    public function setUp()
    {
        $this->order('id', 'desc')
            ->permissions('daily_circulation')
            ->setRowId('id')
            ->buttons('filters', 'print', 'excel', 'csv', 'refresh')
            ->pageLength(20)
            ->condensed()
            ->stateSave();
    }

    public function columns(): array
    {
        return [
            Column::add(__('#Id'))
                ->data('id'),

            Column::add(__('বিক্রির তারিখ'))
                ->data('sell_date')
                ->dateFormat(__('D/M/Y')),

            Column::add(__('হকার/এজেন্সি'))
                ->data('buyer_name'),

            Column::add(__('পত্রিকার সংখ্যা'))
                ->data('sell_quantity'),

            Column::add(__('পত্রিকার মূল্য'))
                ->data('per_price'),

            Column::add(__('মোট টাকা'))
                ->data('total_price'),

                /*
            Column::add(__('Created At'))
                ->data('created_at'),

            Column::add(__('Updated At'))
                ->data('updated_at'),

                */
            Column::add()
                ->width('20px')
                ->actions(function (DailyCirculation $dailycirculation) {
                    return join([
                         Button::show('backend.daily.show', $dailycirculation),
                         Button::edit('backend.daily.edit', $dailycirculation),
                         Button::delete('backend.daily.destroy', $dailycirculation),
                    ]);
                }),
        ];
    }
}
