<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Incident Details') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <!-- Adding Collaborator -->
            @if ($incident->author_id == Auth::id())
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <!-- <x-jet-button wire:click="$set('isAddingCollaborator', true)" 
                        wire:loading.attr="disabled" class="mb-4">
                        Add Collaborator
                    </x-jet-button> -->
                    <div>
                        <select class="form-control" id="select2-dropdown" wire:model="selectedCollaborator">
                            <option value="">Select Option</option>
                            @foreach($users as $id => $user)
                                <option value="{{ $id }}">{{ $user }}</option>
                            @endforeach
                        </select>
                        <x-jet-button 
                            wire:click="submitCollaborator" 
                            wire:loading.attr="disabled">
                            {{ __('Add') }}
                        </x-jet-button>
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
                    @if (!empty($incident->collaborators))
                        <div class="mt-4">
                            <x-jet-label for="collaborators" value="{{ __('Collaborators') }}" />
                            <p id="collaborators">
                                @foreach ($incident->collaborators as $collaborator)
                                    @if ($collaborator == $incident->collaborators->last())
                                        <span>{{ $collaborator->user->name }}</span>
                                    @else
                                        <span>{{ $collaborator->user->name }}, </span>
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    @endif
                    <!-- <div>
                        <x-jet-label for="severity" value="{{ __('Add Collaborators') }}" />
                        <select id="severity" name="status"
                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            wire:model="actionFormChangeset.status"
                        >
                            <option value="0">Pending</option>
                            <option value="1">In Progress</option>
                            <option value="2">Done</option>
                        </select>
                    </div> -->
                </div>
            @endif

            <!-- Incident and friends -->
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="mb-4">
                    <span class="text-sm font-medium bg-green-100 py-1 px-2 rounded text-green-500">
                        Incident
                    </span>
                </div>
                <div>
                    <x-jet-label for="title" value="{{ __('Title') }}" />
                    <p id='title'>{{ $incident->title }}</p>
                </div>
                <div class="mt-4">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <p id="description">{{ $incident->description }}</p>
                </div>
                <div class="mt-4">
                    <x-jet-label for="severity" value="{{ __('Severity') }}" />
                    <p id="severity">{{ $incident->severityLabel }}</p>
                </div>
                <div class="mt-4">
                    <x-jet-label for="status" value="{{ __('Status') }}" />
                    <p id='status'>{{ $incident->statusLabel }}</p>
                </div>
                <div class="mt-4">
                    <x-jet-label for="author" value="{{ __('Author') }}" />
                    <p id='author'>{{ $incident->author->name }}</p>
                </div>
            </div>

            <!-- Investigation -->
            @if (!empty($incident->investigation))
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <span class="text-sm font-medium bg-green-100 py-1 px-2 rounded text-green-500">
                            Investigation
                        </span>
                    </div>
                    <div>
                        <x-jet-label for="incresult" value="{{ __('Result') }}" />
                        <p id='incresult'>{{ $incident->investigation->result }}</p>
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="incstatus" value="{{ __('Status') }}" />
                        <p id="incstatus">{{ $incident->investigation->statusLabel }}</p>
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="investigator" value="{{ __('Investigator') }}" />
                        <p id="investigator">{{ $incident->investigation->investigator->name }}</p>
                    </div>
                    @if ($incident->investigation->investigator->id == Auth::user()->id)
                        <div class="mt-4">
                            <x-jet-button wire:click="editInvestigation" wire:loading.attr="disabled" class="mb-4">
                                Edit Investigation
                            </x-jet-button>
                        </div>
                    @endif
                </div>
            @else
                @if ($incident->isCollaborator(Auth::user()))
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <x-jet-button wire:click="addInvestigation" wire:loading.attr="disabled" class="mb-4">
                            Add Investigation
                        </x-jet-button>
                    </div>
                @endif
            @endif

            <!-- Action -->
            @if (!empty($incident->action))
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <span class="text-sm font-medium bg-green-100 py-1 px-2 rounded text-green-500">
                            Action
                        </span>
                    </div>
                    <div>
                        <x-jet-label for="actresult" value="{{ __('Result') }}" />
                        <p id='actresult'>{{ $incident->action->result }}</p>
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="repeatable" value="{{ __('Can it re-occur?') }}" />
                        <x-jet-checkbox id="repeatable" wire:model='isCheckedActionRepeatable' disabled />
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="actstatus" value="{{ __('Status') }}" />
                        <p id="actstatus">{{ $incident->action->status }}</p>
                    </div>
                    <!-- <div class="mt-4">
                        <x-jet-label for="documentation" value="{{ __('Documentation') }}" />
                        <img 
                            class="h-20 w-20 rounded-full object-cover"
                            src="{{ $incident->action->documentation_image_path }}"
                            alt="{{ __('Documentation Image') }}"
                        />
                    </div> -->
                    <!-- <div class="mt-4">
                        <x-jet-label for="form" value="{{ __('Corrective Action Form') }}" />
                        <x-jet-button wire:click="downloadCorrectiveActionForm" wire:loading.attr="disabled" class="mb-4">
                            Download Corrective Action Form
                        </x-jet-button>
                    </div> -->
                    <div class="mt-4">
                        <x-jet-label for="assignee" value="{{ __('Investigator') }}" />
                        <p id="assignee">{{ $incident->action->assignee->name }}</p>
                    </div>
                    @if ($incident->action->assignee->id == Auth::user()->id)
                        <div class="mt-4">
                            <x-jet-button wire:click="editAction" wire:loading.attr="disabled" class="mb-4">
                                Edit Action
                            </x-jet-button>
                        </div>
                    @endif
                    <div class="mt-4">
                        <x-jet-button wire:click="addActionProofImage" wire:loading.attr="disabled" class="mb-4">
                            Add Proof Image
                        </x-jet-button>
                    </div>
                </div>
            @else
                @if ($incident->isCollaborator(Auth::user()))
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <x-jet-button wire:click="addAction" wire:loading.attr="disabled" class="mb-4">
                            Add Action
                        </x-jet-button>
                    </div>
                @endif
            @endif

            <!-- Footer -->
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <x-jet-secondary-button wire:click="back" wire:loading.attr="disabled">
                    Back
                </x-jet-secondary-button>
                <x-jet-button wire:click="edit" wire:loading.attr="disabled">
                    Edit
                </x-jet-button>
            </div>
        </div>
    </div>
</div>

<!-- Add Action Proof Modal -->
<!-- <x-jet-dialog-modal wire:model="isAddingActionProofImage">
    <x-slot name="title">
        {{ __('Upload Image') }}
    </x-slot>

    <x-slot name="content">
        <x-jet-label for="proof" value="{{ __('Add proof image') }}" />
        <input id="proof"
            type="file"
            wire:model="actionProofImage"
            x-ref="actionProofImage" />
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button 
            wire:click="$set('isAddingActionProofImage', false)" 
            wire:loading.attr="disabled">
            {{ __('Close') }}
        </x-jet-secondary-button>
        <x-jet-button 
            wire:click="submitActionProofImage" 
            wire:loading.attr="disabled">
            {{ __('Submit') }}
        </x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal> -->