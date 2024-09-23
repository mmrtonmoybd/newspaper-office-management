<?php

namespace App\Datatables;

use App\Models\PressInk;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Illuminate\Support\Facades\Gate;
use Sebastienheyd\Boilerplate\Datatables\Datatable;

class InkDatatable extends Datatable
{
    public $slug = 'ink';

    public function datasource()
    {
        return PressInk::query();
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
                ->data('id'),

            Column::add(__('কালার'))
                ->data('color'),

            Column::add(__('ক্রয়ের তারিখ'))
                ->data('purchased_date')
                ->dateFormat(__('D/M/Y')),

            Column::add(__('টাকা'))
                ->data('amount'),

            Column::add(__('পরিমান'))
                ->data('quantity'),

            Column::add(__('কালি শেষ হওয়ার তারিখ'))
                ->data('ink_end')
                ->dateFormat(__('D/M/Y')),

            /*
            Column::add(__('Created At'))
                ->data('created_at'),

            Column::add(__('Updated At'))
                ->data('updated_at'),

                */

            Column::add()
                ->width('20px')
                ->actions(function (PressInk $pressink) {
                    return implode([
                        // Button::show('pressink.show', $pressink),
                        (Gate::allows('update', [$pressink->created_at, 'update_ink'])) ? Button::edit('backend.ink.edit', $pressink) : null,
                        (Gate::allows('delete', [$pressink->created_at, 'delete_ink'])) ? Button::delete('backend.ink.destroy', $pressink) : null,
                    ]);
                }),
        ];
    }
}
