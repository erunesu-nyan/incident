<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Incident;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class IncidentsTable extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),
            Column::make('Severity', 'severity')
                ->sortable()
                ->searchable(),
            Column::make('Status', 'status')
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

    public function editIncident()
    {
        return;
    }

    public function deleteIncident()
    {
        return;
    }
}
