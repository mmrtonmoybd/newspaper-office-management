<?php

namespace App\Datatables;

use App\Models\MonthlyCirculationRepen;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;

class RepresentativeDatatable extends Datatable
{
    public $slug = 'representative';

    public function datasource()
    {
        return MonthlyCirculationRepen::query();
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

            Column::add(__('নাম'))
                ->data('name'),

            Column::add(__('ইমেইল'))
                ->data('email'),

            Column::add(__('মোবাইল'))
                ->data('mobile'),

            Column::add(__('ঠিকানা'))
                ->data('address'),

            /*
            Column::add(__('Created At'))
                ->data('created_at'),

            Column::add(__('Updated At'))
                ->data('updated_at'),
                */

            Column::add()
                ->width('20px')
                ->actions(function (MonthlyCirculationRepen $monthlycirculationrepen) {
                    return implode([
                        // Button::show('monthlycirculationrepen.show', $monthlycirculationrepen),
                        Button::edit('backend.representative.edit', $monthlycirculationrepen),
                        Button::delete('backend.representative.destroy', $monthlycirculationrepen),
                    ]);
                }),
        ];
    }
}
