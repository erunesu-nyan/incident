<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Incident;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class IncidentsTable extends DataTableComponent
{
    public $isModalOpen = 0;

    public function columns(): array
    {
        return [
            Column::make('title')
                ->sortable()
                ->searchable(),
            Column::make('severity')
                ->sortable()
                ->searchable(),
            Column::make('Status')
                ->sortable(),
            Column::make('Author'),
            Column::blank(),
            Column::blank(),
        ];
    }

    public function query(): Builder
    {
        return Incident::query();
    }

    public function rowView(): string
    {
        return 'livewire.incidents-table';
    }

    public function createIncident()
    {
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    public function editIncident()
    {
        return;
    }

    public function deleteIncident($id)
    {
        Incident::find($id)->delete();
    }
}
