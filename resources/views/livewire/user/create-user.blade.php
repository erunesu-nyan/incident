<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('New User') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <x-jet-validation-errors class="mb-4" />
                
                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="name" required autofocus />
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" wire:model="email" required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" wire:model="password" required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="phone" value="{{ __('Phone Number') }}" />
                    <x-jet-input id="phone" class="block mt-1 w-full" type="tel" name="phone" wire:model="phone" required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="address" value="{{ __('Address') }}" />
                    <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" wire:model="address" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="is_admin" value="{{ __('Grant Admin Previleges') }}" />
                    <x-jet-checkbox id="is_admin" wire:model="is_admin" />
                </div>

                <div class="mt-4">
                    <x-jet-button wire:click="back">
                        {{ __('Back') }}
                    </x-jet-button>
                    <x-jet-button wire:click="createUser" wire:loading.attr="disabled">
                        {{ __('Save') }}
                    </x-jet-button>
                </div>
            </div>
        </div>
    </div>
</div>