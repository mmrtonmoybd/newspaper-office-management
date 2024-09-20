<?php

namespace App\Datatables;

use App\Models\MonthlyCirculation;
use App\Models\MonthlyCirculationRepen;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;

class MonthlyDatatable extends Datatable
{
    public $slug = 'monthly';

    public function datasource()
    {
        return MonthlyCirculation::with('representative')->select('monthly_circulations.*');
    }

    public function setUp()
    {
        $this->order('id', 'desc')
            ->permissions('press_ink')
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
                ->data('id')
                ->name('monthly_circulations.id'),

            Column::add(__('প্রতিনিধির নাম'))
                ->data('representative.name')
                ->name('representative.name')
                ->filterOptions(function () {
                    return MonthlyCirculationRepen::all()->pluck('name', 'name')->toArray();
                }),

            Column::add(__('উপজেলার নাম'))
                ->data('district'),

            Column::add(__('প্রতিদিন প্রেরণকৃত প্রত্রিকার সংখ্যা'))
                ->data('send_quantity'),

            Column::add(__('মাসিক বিল'))
                ->data('monthly_bill'),

            Column::add(__('পরিশোধিত বিল'))
                ->data('paid_bill'),

            Column::add(__('পরিশোধের তারিখ'))
                ->data('paid_date')
                ->dateFormat(__('D/M/Y')),

            Column::add(__('চলতি বকেয়া'))
                ->data('due_bill'),

            Column::add(__('মন্তব্য'))
                ->data('comment'),

            Column::add(__('তারিখ'))
                ->data('created_at')
                ->dateFormat(__('D/M/Y')),

                /*
            Column::add(__('Updated At'))
                ->data('updated_at'),

                */

            Column::add()
                ->width('20px')
                ->actions(function (MonthlyCirculation $monthlycirculation) {
                    return join([
                        // Button::show('monthlycirculation.show', $monthlycirculation),
                         Button::edit('backend.monthly.edit', $monthlycirculation),
                         Button::delete('backend.monthly.destroy', $monthlycirculation),
                    ]);
                }),
        ];
    }
}
