<div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 pt-4">

    <!-- Shopping List Top Navigation -->
    <div class="block flex items-center gap-3">
        <a href="{{ route('shoppingLists.index') }}">
            <x-svg.chevron-left class="h-5 w-5" />
        </a>

        @include('shopping-lists.fast-switch')

        <div class="flex gap-3 uppercase ml-auto">
            <button wire:click="$set('showHave', false)" wire:loading.attr="disabled" wire:loading.class="opacity-50" class="flex items-center {{ ! $showHave ?: 'text-gray-400'}}">
                <span class="border-dotted border-b-2 border-light-blue-500 uppercase text-sm">Shop</span>
            </button>

            <button wire:click="$set('showHave', true)" wire:loading.attr="disabled" wire:loading.class="opacity-50" class="flex items-center {{ $showHave ?: 'text-gray-400'}}">
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
                <x-svg.x-circle class="h-7 w-7" />
            </button>
            @endif
        </div>
        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                x-data @click="$wire.emit('createItemFromSearch','{{ $search }}')" style="padding: .675rem;">
            <x-svg.plus-sm class="h-5 w-5" />
        </button>
    </div>


    <!-- items -->
    <ul wire:sortable="updateItemOrder" wire:loading.class="opacity-50" wire:target="changeList" class="space-y-1 mt-4">
        @forelse($this->Items as $item)
        <li @if($activeList) wire:sortable.item="{{ $item->id }}" @endif wire:key="item-{{ $item->id }}"
            class="bg-white flex items-center p-2 gap-3 shadow-md rounded-md">

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
        <li class="flex items-center justify-center bg-indigo-400 rounded-md" style="min-height: 45px;">
            <span class="text-sm uppercase text-white font-semibold ">{{ $this->EmptyMessage }}</span>
        </li>
        @endforelse
    </ul>

    <!-- itemsNotInList -->
    @if($this->Items->isEmpty() && $search && ! $this->ItemsNotInList->isEmpty())
    <h3 class="uppercase font-medium text-sm mt-4">Items from other lists</h3>

    <ul class="space-y-1 mt-1 pb-16" wire:loading.class="opacity-50">
        @foreach ($this->ItemsNotInList as $item)
        <li wire:key="item-{{ $item->id }}" class="bg-gray-100 flex items-center p-2 gap-3 shadow-md rounded-md">

            <input wire:click="checkItem({{$item->id}})" type="checkbox" id="item-have-{{ $item->id }}" name="have"
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   {{ $item->have ? 'checked' : '' }}>

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

    @push('modals')
    <livewire:items.add-item-modal :shoppingList="$activeList" />
    @endpush
</div>
