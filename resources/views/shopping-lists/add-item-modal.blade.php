<div>
    <x-jet-button wire:click="create" wire:loading.attr="disabled">
        <x-svg.plus-sm class="h-5 w-5" />
    </x-jet-button>

    <x-jet-dialog-modal wire:model="showItemModal">
        <x-slot name="title">
            {{ $item->id ? 'Edit' : 'New' }} Item
        </x-slot>

        <x-slot name="content">

            <x-jet-input x-ref="name" wire:model="item.name" class="px-2 py-2 w-full" placeholder="Item name..." />

            <h4 class="mt-4 text-xs uppercase">Shopping Lists</h4>

            <div class="shopping-lists mt-1 gap-1">
                @foreach($shoppingLists as $list)
                <button wire:click="toggleList({{ $list->id }})" wire:key=list-"{{ $list->id }}" class="flex items-center">
                    @if (isset($itemShoppingLists[$list->id]) || ($shoppingList?->id == $list->id && ! $item->id) )
                    <svg class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    @else
                    <svg class="mr-2 h-5 w-5 text-gray-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    @endif
                    <span class="truncate">{{ $list->name }}</span>
                </button>
                @endforeach
            </div>

        </x-slot>

        <x-slot name="footer" class="flex justify-between">
            <x-jet-secondary-button class="flex items-center" wire:click="delete" wire:loading.attr="disabled">
                <x-svg.trash class="h-5 w-5 text-red-500" />
            </x-jet-secondary-button>

            <x-jet-secondary-button class="ml-auto" wire:click="$toggle('showItemModal')" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="save" wire:loading.attr="disabled">
                Save
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
