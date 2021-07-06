<?php

namespace App\Http\Livewire;

use App\Models\Incident;
use App\Http\Livewire\IncidentsTable;
use App\Models\IncidentCollaborator;
use Illuminate\Database\Eloquent\Builder;

class DashboardIncidentsTable extends IncidentsTable
{
    public function query(): Builder
    {
        $incidentIds = IncidentCollaborator::where('user_id', \Auth::id())
            ->pluck('incident_id')->toArray();
        return Incident::whereIn('id', $incidentIds);
    }
}
