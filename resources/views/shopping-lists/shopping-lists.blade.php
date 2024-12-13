<div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 pt-4">
    <h2 class="text-xl flex items-center font-semibold">Shopping Lists</h2>
    @include('components.search-filter')

    <ul wire:loading.class="opacity-50" class="space-y-1 mt-4 cursor-pointer card">
        @foreach ($this->ShoppingLists as $item)
        <li wire:key="item-{{ $item->id }}" class="card bg-white flex items-center p-2 gap-3 shadow-md rounded-md">
            <a href="{{ route('shoppingLists.show', $item->id ) }}"
               class="card-link flex items-center flex-grow truncate">
                <h4 class="flex-grow text-lg">
                    {{ $item->name }}
                    <small class="text-sm text-gray-400">
                        {{ $item->items_needed_count .'/'. $item->items_count }}
                    </small>
                </h4>
            </a>

            <button wire:click="$emit('editShoppingList', '{{ $item->id }}')" wire:loading.attr="disabled"
                    class="text-gray-400">
                <x-svg.edit class="h-5 w-5" />
            </button>
        </li>
        @endforeach
    </ul>

    @push('modals')
    <livewire:shopping-lists.add-list-modal />
    @endpush
</div>
