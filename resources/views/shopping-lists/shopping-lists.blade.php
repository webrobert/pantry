<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 mt-4">

    <!-- filters -->
    <div class="block mt-4 flex items-center gap-3">
        <div class="search relative w-full">
            <x-jet-input wire:model="search" class="px-2 py-2 text-lg w-full" placeholder="Search" />
            @if($search)
                <button wire:click="$set('search', '')" wire:loading.attr="disabled" wire:loading.class="opacity-50"
                        class="absolute right-0 top-0 flex-none text-gray-400 p-2 px-3 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </button>
            @endif
        </div>
    </div>


    <ul class="space-y-1 mt-4 cursor-pointer card" wire:loading.class="opacity-50">
        @foreach ($shoppingLists as $item)
        <li wire:key="item-{{ $item->id }}" class="card bg-white flex items-center p-2 gap-3 shadow-md rounded-sm">
            <a class="card-link flex items-center flex-grow truncate" href="{{ route('shoppingLists.show', $item->id ) }}">
                <h4 class="flex-grow text-lg">{{ $item->name }}</h4>
            </a>

            <button wire:click="$emit('editShoppingList', '{{ $item->id }}')" wire:loading.attr="disabled" class="text-gray-400">
                <x-svg.edit class="h-5 w-5" />
            </button>
        </li>
        @endforeach
    </ul>

    @push('modals')
    <!-- fixed nav -->
    <nav class="fixed bottom-0 inset-x-0 bg-blue-300 flex justify-between text-sm text-blue-900 uppercase font-mono items-center p-2 pb-6 px-2 sm:px-6 lg:px-8">
        <span></span>
        <livewire:shopping-lists.add-list-modal />
    </nav>
    @endpush
</div>
