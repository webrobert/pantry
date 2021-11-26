<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 mt-4">

    <!-- Shopping List Top Navigation -->
    <div class="block flex items-center gap-3 justify-between">

        <livewire:shopping-lists.fast-switch :activeList="$activeList" />

        <div class="flex gap-3 uppercase">
            <button wire:click="$toggle('showHave')" wire:loading.attr="disabled" wire:loading.class="opacity-50" class="flex items-center {{ ! $showHave ?: 'text-gray-400'}}">
                <span class="border-dotted border-b-2 border-light-blue-500 uppercase text-sm">Shop</span>
            </button>

            <button wire:click="$toggle('showHave')" wire:loading.attr="disabled" wire:loading.class="opacity-50" class="flex items-center {{ $showHave ?: 'text-gray-400'}}">
                <span class="border-dotted border-b-2 border-light-blue-500 uppercase text-sm">Manage</span>
            </button>
        </div>
    </div>

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


    <!-- items -->
    <ul wire:sortable="updateItemOrder" class="space-y-1 mt-4 pb-16" wire:loading.class="opacity-50">
        @forelse($items as $item)
        <li @if($activeList) wire:sortable.item="{{ $item->id }}" @endif wire:key="item-{{ $item->id }}"
            class="bg-white flex items-center p-2 gap-3 shadow-md rounded-sm">

            <label class="-m-2 flex-none p-2 px-3 flex items-center">
                <input type="checkbox" id="item-have-{{ $item->id }}" name="have" wire:click="checkItem({{$item->id}})" {{ $item->have ? 'checked' : '' }}
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </label>

            <h4 class="flex-grow text-lg truncate">{{ $item->name }}</h4>

            @if($showHave)
            <div class="text-gray-400 flex items-center gap-3">
                <button wire:click="$emit('editItem', '{{ $item->id }}')" wire:loading.attr="disabled" wire:loading.class="opacity-50"
                        class="-m-2 flex-none p-2 px-3 flex items-center transform focus:scale-95">
                    <x-svg.edit class="h-5 w-5" />
                </button>
                @if($activeList)
                <button wire:sortable.handle
                        class="-m-2 flex-none p-2 px-3 flex items-center pr-4 transform active:scale-110">
                    <x-svg.selector class="h-5 w-5" />
                </button>
                @endif
            </div>
            @endif
        </li>
        @empty
        <li>
            {{ $this->EmptyMessage }}
        </li>
        @endforelse
    </ul>


    @if($items->isEmpty() && $search )

        <div class="flex items-center justify-center bg-blue-300 rounded-md" style="min-height: 100px; margin-top: -3.5rem">
            <div class="flex flex-col items-center">
                <h3 class="uppercase font-medium text-sm">
                    "<b>{{ $search }}</b>" not found.</h3>

                <x-jet-secondary-button class="mt-3 flex items-center justify-center" wire:click="$emit('createItemFromSearch','{{ $search }}' )">
                    <x-svg.plus-sm class="h-5 w-5 mr-1" />
                    <span>add</span>
                </x-jet-secondary-button>
            </div>
        </div>

        @if(!$itemsNotInList->isEmpty())
        <h3 class="uppercase font-medium text-sm mt-4">Items from other lists</h3>
        <!-- itemsNotInList -->
        <ul class="space-y-1 mt-1 pb-16" wire:loading.class="opacity-50">
        @foreach ($itemsNotInList as $item)
            <li wire:key="item-{{ $item->id }}" class="bg-gray-50 flex items-center p-2 gap-3 shadow-md rounded-sm">

                <input type="checkbox" id="item-have-{{ $item->id }}" name="have" wire:click="checkItem({{$item->id}})" {{ $item->have ? 'checked' : '' }}>

                <h4 class="flex-grow">{{ $item->name }}</h4>

                @if($showHave)
                <div class="text-gray-400 flex items-center gap-3">
                    <button wire:click="$emit('editItem', '{{ $item->id }}')" wire:loading.attr="disabled" wire:loading.class="opacity-50">
                        <x-svg.edit class="h-5 w-5" />
                    </button>
                </div>
                @endif
            </li>
        @endforeach
        </ul>
        @endif

    @endif


    @push('modals')
    <!-- fixed nav -->
    <nav class="fixed bottom-0 inset-x-0 bg-blue-300 flex justify-between items-center p-2 px-2 pb-6 sm:px-6 lg:px-8">
        <span></span>
        <livewire:items.add-item-modal :shoppingList="$activeList" />
    </nav>
    @endpush
</div>
