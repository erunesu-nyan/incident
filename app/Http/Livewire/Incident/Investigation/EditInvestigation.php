<?php

namespace App\Http\Livewire\Incident\Investigation;

use Livewire\Component;
use App\Models\Investigation;

class EditInvestigation extends Component
{
    public array $investigationFormChangeset = [];
    public Investigation $investigation;

    public function mount()
    {
        $this->investigationFormChangeset = $this->investigation->attributesToArray();
    }

    public function render()
    {
        return view('livewire.incident.investigation.edit-investigation');
    }

    public function cancel()
    {
        return redirect()->to('/dashboard');
    }

    public function saveInvestigation()
    {
        if (!empty($this->investigationFormChangeset)) {
            $this->investigation->fill($this->investigationFormChangeset);
            $this->investigation->investigator_id = \Auth::id();
            $this->investigation->save();
        }
        $idToRedirect = $this->investigation->incident->id;
        return redirect()->to("/incidents/$idToRedirect");
    }
}
