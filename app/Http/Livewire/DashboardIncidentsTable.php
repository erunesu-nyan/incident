<?php

namespace App\Http\Livewire;

use App\Models\Incident;
use App\Http\Livewire\IncidentsTable;
use Illuminate\Database\Eloquent\Builder;

class DashboardIncidentsTable extends IncidentsTable
{
    public function query(): Builder
    {
        return Incident::where('author_id', \Auth::id());
    }
}
