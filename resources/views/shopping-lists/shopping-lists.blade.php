<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 mt-4">

    <!-- filters -->
    <div class="block mt-4 flex items-center gap-3">
        <x-jet-input wire:model="search" class="px-2 py-2 flex-grow" placeholder="Search" />
    </div>

    <ul wire:sortable="updateItemOrder" class="space-y-1 mt-4 cursor-pointer card" wire:loading.class="opacity-50">
        @foreach ($shoppingLists as $item)
        <li wire:sortable.item="{{ $item->id }}" wire:key="item-{{ $item->id }}" class="card bg-white flex items-center p-2 gap-3 shadow-md rounded-sm">
            <a class="card-link flex items-center flex-grow" href="{{ route('shoppingLists.show', $item->id ) }}">
                <h4>{{ $item->name }}</h4>
            </a>

            <button wire:click="$emit('editShoppingList', '{{ $item->id }}')" wire:loading.attr="disabled" class="text-gray-400">
                <x-svg.edit class="h-5 w-5" />
            </button>
        </li>
        @endforeach
    </ul>

    @push('modals')
    <!-- fixed nav -->
    <nav class="fixed bottom-0 inset-x-0 bg-blue-300 flex justify-between text-sm text-blue-900 uppercase font-mono items-center p-2 px-2 sm:px-6 lg:px-8">
        <span></span>
        <livewire:shopping-lists.add-list-modal />
    </nav>
    @endpush
</div>
