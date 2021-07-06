<x-livewire-tables::table.cell>
    {{ $row->title }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->severityLabel }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->statusLabel }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->author->name }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <x-jet-button class="bg-green-700" wire:click="read({{ $row->id }})">Details</x-jet-button>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <x-jet-button class="bg-purple-700" wire:click="edit({{ $row->id }})">Edit</x-jet-button>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <x-jet-button class="bg-red-700" wire:click="delete({{ $row->id }})">Delete</x-jet-button>
</x-livewire-tables::table.cell>