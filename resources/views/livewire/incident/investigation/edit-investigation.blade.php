<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Investigation') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div>
                    <x-jet-label for="result" value="{{ __('Result') }}" />
                    <textarea id="result" class="block mt-1 w-full" name="result" wire:model="investigationFormChangeset.result" required ></textarea>
                </div>

                <div class="mt-4">
                    <x-jet-label for="severity" value="{{ __('Status') }}" />
                    <select id="severity" name="status"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        wire:model="investigationFormChangeset.status"
                    >
                        <option value="0">Pending</option>
                        <option value="1">In Progress</option>
                        <option value="2">Done</option>
                    </select>
                </div>  

                <div class="mt-4">
                    <x-jet-secondary-button wire:click="cancel" wire:loading.attr="disabled">
                        Cancel
                    </x-jet-secondary-button>
                    <x-jet-button wire:click="saveInvestigation" wire:loading.attr="disabled">
                        Submit
                    </x-jet-button>
                </div>
            </div>
        </div>
    </div>
</div>