<?php

namespace App\Http\Livewire\Incident;

use Livewire\Component;
use App\Models\Incident;

class EditIncident extends Component
{
    public Incident $incident;
    public array $incidentFormModel;

    public function mount()
    {
        $this->incidentFormModel['title'] = $this->incident->title;
        $this->incidentFormModel['description'] = $this->incident->description;
        $this->incidentFormModel['severity'] = $this->incident->severity;
    }

    public function render()
    {
        return view('livewire.incident.edit-incident');
    }

    public function cancel()
    {
        return redirect()->to('/dashboard');
    }

    public function saveIncident()
    {
        if (!empty($this->incidentFormModel)) {
            $this->incident->title = $this->incidentFormModel['title'];
            $this->incident->description = $this->incidentFormModel['description'];
            $this->incident->severity = $this->incidentFormModel['severity'];
            $this->incident->save();
        }
        $idToRedirect = $this->incident->id;
        return redirect()->to("/incidents/$idToRedirect");
    }
}
