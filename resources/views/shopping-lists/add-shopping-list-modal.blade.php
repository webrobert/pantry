<x-jet-dialog-modal wire:model="showListModal">
    <x-slot name="title">
        {{ $list->id ? 'Edit' : 'New' }} Shopping List
    </x-slot>

    <x-slot name="content">
        <x-jet-input x-ref="name" wire:model="list.name" class="px-2 py-2 flex-grow" placeholder="List name..." class="px-2 py-2 w-full"/>
    </x-slot>

    <x-slot name="footer" class="flex justify-between">
        <x-jet-secondary-button class="flex items-center" wire:click="delete" wire:loading.attr="disabled">
            <x-svg.trash class="h-5 w-5 text-red-500" />
        </x-jet-secondary-button>

        <x-jet-secondary-button class="ml-auto" wire:click="$toggle('showListModal')" wire:loading.attr="disabled">
            Nevermind
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="save" wire:loading.attr="disabled">
            Save
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
