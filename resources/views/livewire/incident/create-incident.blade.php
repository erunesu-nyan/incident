<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create Incident') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div>
                    <x-jet-label for="title" value="{{ __('Title') }}" />
                    <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" wire:model="incidentFormChangeset.title" required autofocus autocomplete="title" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <textarea id="description" class="block mt-1 w-full" name="description" wire:model="incidentFormChangeset.description" required ></textarea>
                </div>

                <div class="mt-4">
                    <x-jet-label for="severity" value="{{ __('Severity') }}" />
                    <select id="severity" name="severity"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        wire:model="incidentFormChangeset.severity"
                    >
                        <option value="0">-</option>
                        <option value="1">Very Low</option>
                        <option value="2">Low</option>
                        <option value="3">Medium</option>
                        <option value="4">High</option>
                        <option value="5">Very High</option>
                    </select>
                </div>  

                <div class="mt-4">
                    <x-jet-secondary-button wire:click="cancel" wire:loading.attr="disabled">
                        Cancel
                    </x-jet-secondary-button>
                    <x-jet-button wire:click="saveIncidentFormChangeset" wire:loading.attr="disabled">
                        Submit
                    </x-jet-button>
                </div>
            </div>
        </div>
    </div>
</div>