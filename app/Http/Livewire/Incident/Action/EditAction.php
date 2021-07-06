<?php

namespace App\Http\Livewire\Incident\Action;

use Livewire\Component;
use App\Models\Action;
use Livewire\WithFileUploads;

class EditAction extends Component
{
    use WithFileUploads;

    public array $actionFormChangeset = [];
    public Action $action;

    public function mount()
    {
        $this->actionFormChangeset = $this->action->attributesToArray();
    }

    public function render()
    {
        return view('livewire.incident.action.edit-action');
    }

    public function cancel()
    {
        return redirect()->to('/dashboard');
    }

    public function saveAction()
    {
        if (!empty($this->actionFormChangeset)) {
            $this->action->fill($this->actionFormChangeset);
            $this->action->assignee_id = \Auth::id();
            $this->action->save();
        }
        $idToRedirect = $this->action->incident->id;
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
