<?php

namespace App\Datatables;

use App\Models\PressPaper;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;

class PaperDatatable extends Datatable
{
    public $slug = 'paper';

    public function datasource()
    {
        return PressPaper::query();
    }

    public function setUp()
    {
        $this->order('id', 'desc')
            ->permissions('press_paper')
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

            Column::add(__('রোল নং'))
                ->data('roll'),

            Column::add(__('রোলের ওজন'))
                ->data('roll_weight'),

            Column::add(__('ছাপার অর্ডার'))
                ->data('published_order'),

            Column::add(__('ওসেস্টেজ'))
                ->data('wastage'),

            Column::add(__('Total'))
                ->data('total'),

            Column::add(__('তারিখ'))
                ->data('date')
                ->dateFormat(__('D/M/Y')),

            /*
            Column::add(__('Created At'))
                ->data('created_at'),

            Column::add(__('Updated At'))
                ->data('updated_at'),
                */

            Column::add()
                ->width('20px')
                ->actions(function (PressPaper $presspaper) {
                    return implode([
                        // Button::show('backend.paper.show', $presspaper),
                        Button::edit('backend.paper.edit', $presspaper),
                        Button::delete('backend.paper.destroy', $presspaper),
                    ]);
                }),
        ];
    }
}
