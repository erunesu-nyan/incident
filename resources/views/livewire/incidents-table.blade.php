<x-livewire-tables::table.cell>
    {{ $row->title }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->severity }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->status }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->author->name }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <x-jet-button class="bg-purple-700" wire:click="editIncident">Edit</x-jet-button>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <x-jet-button class="bg-red-700" wire:click="deleteIncident">Delete</x-jet-button>
</x-livewire-tables::table.cell>