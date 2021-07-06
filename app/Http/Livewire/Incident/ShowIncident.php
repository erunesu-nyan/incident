<?php

namespace App\Http\Livewire\Incident;

use Livewire\Component;
use App\Models\Incident;
use App\Models\User;
use App\Models\IncidentCollaborator;
use Illuminate\Support\Facades\Auth;

class ShowIncident extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    public Incident $incident;
    public bool $isCheckedActionRepeatable;
    
    // proof image modal
    public bool $isAddingActionProofImage = false;
    public array $actionProofImageCollection = [];
    public $actionProofImage;

    // collaborator modal
    public bool $isAddingCollaborator = false;
    public array $users = [];
    public $selectedCollaborator;

    public function mount() {
        $this->isCheckedActionRepeatable = $this->incident->action->repeatable;
        $collectionOfUsers = User::all();
        foreach ($collectionOfUsers as $user) {
            $this->users[$user->id] = $user->name;
        }
    }

    public function render()
    {
        return view('livewire.incident.show-incident');
    }

    public function addInvestigation()
    {
        $incidentId = $this->incident->id;
        return redirect()->to("investigations/create/$incidentId");
    }

    public function editInvestigation()
    {
        $investigationId = $this->incident->investigation->id;
        return redirect()->to("investigations/edit/$investigationId");
    }

    public function addAction()
    {
        $incidentId = $this->incident->id;
        return redirect()->to("actions/create/$incidentId");
    }

    public function editAction()
    {
        $incidentId = $this->incident->id;
        return redirect()->to("actions/edit/$incidentId");
    }

    public function downloadCorrectiveActionForm()
    {
        $path = storage_path(
            'app'
            . DIRECTORY_SEPARATOR
            . $this->incident->action->corrective_action_form_file_path
        );
        return response()->download($path);
    }

    // start of action proof image modal

    public function addActionProofImage()
    {
        $this->isAddingActionProofImage = true;
    }

    // end of section

    // start of collaborator modal

    public function submitCollaborator()
    {
        if (!empty($this->selectedCollaborator)) {
            $collaborator = new IncidentCollaborator;
            $collaborator->user_id = $this->selectedCollaborator;
            $collaborator->incident_id = $this->incident->id;
            $collaborator->save();
            $this->emit('refreshComponent');
        }
    }

    // end of section

    public function back()
    {
        return redirect()->to('/dashboard');
    }

    public function edit()
    {
        $incidentId = $this->incident->id;
        return redirect()->to("/incidents/edit/$incidentId");
    }
}
