<x-livewire-tables::table.cell>
    {{ $row->name }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->email }}
</x-livewire-tables::table.cell>

<!-- <x-livewire-tables::table.cell>
    {{ $row->email_verified_at }}
</x-livewire-tables::table.cell> -->

<x-livewire-tables::table.cell>
    @if ($row->is_admin)
        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-green-100 bg-green-700 rounded">Yes</span>
    @else
        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-700 rounded">No</span>
    @endif
</x-livewire-tables::table.cell>

@if ($row->is_admin)
    <x-livewire-tables::table.cell>
        <x-jet-button class="bg-yellow-700" wire:click="demoteUser{{ $row->id }}">Disable Admin</x-jet-button>
    </x-livewire-tables::table.cell>
@endif

<x-livewire-tables::table.cell>
    <x-jet-button class="bg-red-700" wire:click="deleteUser{{ $row->id }}">Delete</x-jet-button>
</x-livewire-tables::table.cell>