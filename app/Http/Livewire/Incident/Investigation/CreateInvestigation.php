<?php

namespace App\Http\Livewire\Incident\Investigation;

use Livewire\Component;
use App\Models\Investigation;

class CreateInvestigation extends Component
{
    public array $investigationFormModel = [];
    public $incidentId;
    
    public function mount($incidentId)
    {
        $this->incidentId = $incidentId;
    }

    public function render()
    {
        return view('livewire.incident.investigation.create-investigation');
    }

    public function cancel()
    {
        return redirect()->to('/dashboard');
    }

    public function saveInvestigation()
    {
        if (!empty($this->investigationFormModel)) {
            $investigation = new Investigation;
            $investigation->result = $this->investigationFormModel['result'];
            $investigation->status = $this->investigationFormModel['status'];
            $investigation->investigator_id = \Auth::id();
            $investigation->incident_id = $this->incidentId;
            $investigation->save();
        }
        $idToRedirect = $this->incidentId;
        return redirect()->to("/incidents/$idToRedirect");
    }
}
