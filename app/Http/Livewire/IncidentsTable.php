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
            Column::make('title')
                ->sortable()
                ->searchable(),
            Column::make('severity')
                ->sortable()
                ->searchable(),
            Column::make('Status')
                ->sortable()
                ->searchable(),
            Column::make('Author')
                ->sortable()
                ->searchable(function (Builder $query, $searchTerm) {
                    $query->orWhereHas('author', function ($query) use ($searchTerm) {
                        $query->where('name', 'LIKE', "%{$searchTerm}%");
                    });
                }),
            Column::blank(),
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

    public function read(int $id)
    {
        return redirect()->to("/incidents/$id");
    }

    public function edit(int $id)
    {
        return redirect()->to("/incidents/edit/$id");;
    }

    public function delete(int $id)
    {
        $incident = Incident::where('id', $id);
        $incident->delete();
        $this->refresh = true;
    }
}
