<div>
    <x-jet-dialog-modal wire:model="showItemModal">
        <x-slot name="title">{{ $item->id ? 'Edit' : 'New' }} Item</x-slot>

        <x-slot name="content">

            <div class="relative w-full">
                <x-jet-input x-ref="name" wire:model="item.name" class="px-2.5 py-2.5 w-full shadow-lg" placeholder="Item name..." />

                <div class="flex items-center absolute right-2 top-2">
                    <svg wire:click="decrementQty" class="w-7 text-green-600" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>

                    <span class="text-sm w-5 text-center">{{ $item->quantity ?? 1 }}</span>

                    <svg wire:click='incrementQty' class="w-7 text-green-600" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path  d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>

            <div class="mt-4 on-lists" x-data="{itemLists : false}" @click.away="itemLists = false">
                <x-input-with-floating-label>
                    @slot('value', $this->shoppingLists->filter( fn($list) => $this->showOn($list))->map->name->join(', ', ' and '))
                    @slot('label', 'On shopping lists')
                    @slot('action')
                        <div @click="itemLists = !itemLists" class="absolute inset-0 flex justify-end z-20">
                            <div class="ml-auto flex items-center px-2 pt-1">
                                <svg class="h-7 w-7" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                                    <path class="text-green-400" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    @endslot
                </x-input-with-floating-label>

                <div x-show="itemLists">
                    <h4 class="mt-2 text-xs uppercase">Shopping Lists</h4>

                    <div class="shopping-lists mt-1 gap-1 ml-1.5">
                        @foreach($this->shoppingLists as $list)
                            <button wire:click="toggleList({{ $list->id }})"
                                    wire:key=list-"{{ $list->id }}" class="flex items-center">
                                <svg class="mr-2 h-7 w-7"
                                        {{-- add style conditional here --}}
                                     fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                                    @if ($this->showOn($list))
                                        <path class="text-green-400" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    @else
                                        <path class="text-gray-400" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    @endif
                                </svg>

                                <span class="truncate">{{ $list->name }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-4 buy-next-at" x-data="{buyNextAt : false}" @click.away="buyNextAt = false">
                <x-input-with-floating-label>
                    @slot('label', 'Buy next time at')
                    @slot('value', $this->item->buyNextAt->name ?? '')
                    @slot('action')
                        <div @click="buyNextAt = !buyNextAt" class="absolute inset-0 flex justify-end z-20">
                            <div class="ml-auto flex items-center px-2 pt-1" @if($this->item->buyNextAt) @click="$wire.buyNextAt('clear')" @endif>
                                <svg class="h-7 w-7" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                                    @if ($this->item->buyNextAt)
                                        <path class="text-green-400" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    @else
                                        <path class="text-gray-400" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    @endif
                                </svg>
                            </div>
                        </div>
                    @endslot
                </x-input-with-floating-label>

                <div x-show="buyNextAt">
                    <h4 class="mt-2 text-xs uppercase">Buy next time at</h4>

                    <div class="shopping-lists mt-1 gap-1 ml-1.5">
                        @foreach($this->shoppingLists as $list)
                        <button wire:click="buyNextAt({{ $list->id }})" wire:key=buy-at-"{{ $list->id }}" class="flex items-center">
                            <span class="truncate">{{ $list->name }}</span>
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- <livewire:products.product-suggestions /> --}}
        </x-slot>

        <x-slot name="footer" class="flex justify-between items-center">
            <button class="flex items-center" wire:click="delete" wire:loading.attr="disabled">
                <x-svg.trash class="h-5 w-5 text-red-500" />
            </button>

            <x-jet-secondary-button class="ml-auto" wire:click="$toggle('showItemModal')" wire:loading.attr="disabled">
                Nevermind
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="save" wire:loading.attr="disabled">
                Save
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
