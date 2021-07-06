<?php

namespace App\Http\Livewire\Incident\Action;

use Livewire\Component;
use App\Models\Action;
use Livewire\WithFileUploads;

class CreateAction extends Component
{
    use WithFileUploads;
    
    public array $actionFormChangeset = [];
    public $incidentId;
    public $actionFormFile;
    
    public function mount($incidentId)
    {
        $this->incidentId = $incidentId;
    }

    public function render()
    {
        return view('livewire.incident.action.create-action');
    }

    public function cancel()
    {
        return redirect()->to('/dashboard');
    }

    public function saveAction()
    {
        if (!empty($this->actionFormChangeset)) {
            $action = new Action;
            $action->fill($this->actionFormChangeset);
            // $action->corrective_action_form_file_path = (
            //     $this->validateAndStoreActionFormThenReturnFilePath()
            // );
            $action->assignee_id = \Auth::id();
            $action->incident_id = $this->incidentId;
            $action->save();
        }
        $idToRedirect = $this->incidentId;
        return redirect()->to("/incidents/$idToRedirect");
    }

    public function validateAndStoreActionFormThenReturnFilePath()
    {
        $this->validate([
            'actionFormFile' => 'max:1024',
        ]);
        $path = $this->actionFormFile->store('documents');
        return $path;
    }
}
