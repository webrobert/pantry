<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 pt-4">

    <h2 class="text-xl flex items-center font-semibold">
        Shopping Lists
    </h2>

    <!-- filters -->
    <div class="block mt-4 flex items-center gap-3">
        <div class="search relative w-full">
            <x-jet-input wire:model="search" class="px-2 py-2 text-lg w-full" placeholder="Search" />
            @if($search)
                <button wire:click="$set('search', '')" wire:loading.attr="disabled" wire:loading.class="opacity-50"
                        class="absolute right-0 top-0 flex-none text-gray-400 p-2 px-3 flex items-center">
                    <x-svg.x-circle class="h-7 w-7" />
                </button>
            @endif
        </div>
        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
            x-data @click="$wire.emit('createItemFromSearch','{{ $search }}')" style="padding: .675rem;">
            <x-svg.plus-sm class="h-5 w-5" />
        </button>
    </div>

    <ul class="space-y-1 mt-4 cursor-pointer card" wire:loading.class="opacity-50">
        @foreach ($this->ShoppingLists as $item)
        <li wire:key="item-{{ $item->id }}" class="card bg-white flex items-center p-2 gap-3 shadow-md rounded-md">
            <a class="card-link flex items-center   flex-grow truncate" href="{{ route('shoppingLists.show', $item->id ) }}">
                <h4 class="flex-grow text-lg">{{ $item->name }}
                <small class="text-sm text-gray-400">({{ $item->items_count }}) items</small></h4>
            </a>

            <button wire:click="$emit('editShoppingList', '{{ $item->id }}')" wire:loading.attr="disabled" class="text-gray-400">
                <x-svg.edit class="h-5 w-5" />
            </button>
        </li>
        @endforeach
    </ul>

    @push('modals')
    <livewire:shopping-lists.add-list-modal />
    @endpush
</div>
