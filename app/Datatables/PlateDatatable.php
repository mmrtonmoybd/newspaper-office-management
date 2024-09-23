<?php

namespace App\Datatables;

use App\Models\PressPlate;
use Illuminate\Support\Facades\Gate;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;

class PlateDatatable extends Datatable
{
    public $slug = 'plate';

    public function datasource()
    {
        return PressPlate::query();
    }

    public function setUp()
    {
        $this->order('id', 'desc')
            ->permissions('press_plate')
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

            Column::add(__('ছাপার তারিখ'))
                ->data('published_date')
                ->dateFormat(__('D/M/Y')),

            Column::add(__('অগ্রিম প্রদান'))
                ->data('advance_paid'),

            Column::add(__('কর্তনকৃত টাকা'))
                ->data('cut_amount'),

            Column::add(__('প্রতিদিনের প্লেট'))
                ->data('daily_plate'),

            Column::add(__('নতুন প্লেট'))
                ->data('new_plate'),

            Column::add(__('টোটাল প্লেট'))
                ->data('total_plate'),

            /* Column::add(__('Created At'))
                ->data('created_at'),

            Column::add(__('Updated At'))
                ->data('updated_at'),
            */

            Column::add()
                ->width('20px')
                ->actions(function (PressPlate $pressplate) {
                    return implode([
                        // Button::show('pressplate.show', $pressplate),
                        (Gate::allows('update', [$pressplate->created_at, 'update_plate'])) ? Button::edit('backend.plate.edit', $pressplate) : null,
                        (Gate::allows('delete', [$pressplate->created_at, 'delete_plate'])) ? Button::delete('backend.plate.destroy', $pressplate) : null,
                    ]);
                }),
        ];
    }
}
