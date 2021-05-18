<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class IncidentTable extends DataTableComponent
{
    // public function render(){
    //     return view('livewire.incident-table', [
    //         'users' => User::all(),
    //     ]);
    // }
    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Password', 'password')
                ->sortable()
                ->searchable(),
            Column::make('created_at')
                ->sortable(),
            Column::make('updated_at')
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return User::query();
    }
}