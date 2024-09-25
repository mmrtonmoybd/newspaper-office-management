<?php

namespace App\Datatables;

use App\Models\MonthlyCirculation;
use App\Models\MonthlyCirculationRepen;
use Illuminate\Support\Facades\Gate;
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
            ->permissions('representative_monthly_circulation')
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

            Column::add('মোট বকেয়া')
                ->data('', function (MonthlyCirculationRepen $monthlyCirculationRepen) {
                    $monthly = MonthlyCirculation::where('monthly_circulation_repen_id', $monthlyCirculationRepen->id)->orderBy('id', 'desc')->first();

                    return ! empty($monthly->due_bill) ? $monthly->due_bill : 0;
                })
                ->notSearchable()
                ->notSortable()
                ->notOrderable(),

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
                        Button::show('backend.representative.show', $monthlycirculationrepen),
                        (Gate::allows('update', [$monthlycirculationrepen->created_at, 'update_representative'])) ? Button::edit('backend.representative.edit', $monthlycirculationrepen) : null,
                        (Gate::allows('delete', [$monthlycirculationrepen->created_at, 'delete_representative'])) ? Button::delete('backend.representative.destroy', $monthlycirculationrepen) : null,
                    ]);
                }),
        ];
    }
}
