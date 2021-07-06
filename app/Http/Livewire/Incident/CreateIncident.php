<?php

namespace App\Http\Livewire\Incident;

use Livewire\Component;
use App\Models\Incident;
use App\Models\IncidentCollaborator;
use Illuminate\Support\Facades\Auth;
use Reflector;

class CreateIncident extends Component
{
    public array $incidentFormChangeset = [];

    public function render()
    {
        return view('livewire.incident.create-incident');
    }

    public function cancel()
    {
        return redirect()->to('/dashboard');
    }

    public function saveIncident()
    {
        if (!empty($this->incidentFormChangeset)) {
            $incident = new Incident;
            $incident->title = $this->incidentFormChangeset['title'];
            $incident->description = $this->incidentFormChangeset['description'];
            $incident->severity = $this->incidentFormChangeset['severity'];
            $incident->status = 1;
            $incident->author_id = Auth::user()->id;
            $incident->save();
            // Add author to list of collaborators
            $collaborator = new IncidentCollaborator;
            $collaborator->user_id = $incident->author_id;
            $collaborator->incident_id = $incident->id;
        }
        $idToRedirect = $incident->id;
        return redirect()->to("/incidents/$idToRedirect");
    }
}
