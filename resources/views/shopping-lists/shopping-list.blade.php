<div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 pt-4" wire:loading.class="opacity-50" wire:target="changeList">

    <!-- Shopping List Top Navigation -->
    <div class="block flex items-center gap-3">

        @include('shopping-lists.fast-switch-title')

        <div class="flex gap-3 uppercase ml-auto items-center">
            <button wire:click="$set('showHave', false)" wire:loading.attr="disabled" wire:loading.class="opacity-50" class="flex items-center {{ ! $showHave ?: 'text-gray-400'}}">
{{--                <span class="border-dotted border-b-2 border-light-blue-500 uppercase text-sm">Shop</span>--}}
                <x-svg.shopping-cart class="h-6 w-6"  />
            </button>

            <button wire:click="$set('showHave', true)" wire:loading.attr="disabled" wire:loading.class="opacity-50" class="flex items-center {{ $showHave ?: 'text-gray-400'}}">
{{--                <span class="border-dotted border-b-2 border-light-blue-500 uppercase text-sm">Manage</span>--}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
            </button>
        </div>
    </div>

    @include('components.search-filter')

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

            <div class="text-gray-400 flex items-center gap-3">
                <button wire:click="$emit('editItem', '{{ $item->id }}')" wire:loading.attr="disabled" wire:loading.class="opacity-50"
                        class="-m-2 flex-none p-2 px-3 flex items-center transform focus:scale-95">
                    <x-svg.edit class="h-5 w-5" />
                </button>
                @if($activeList && $showHave)
                <button wire:sortable.handle
                        class="-m-2 flex-none p-2 px-3 flex items-center pr-4 transform active:scale-110">
                    <x-svg.selector class="h-5 w-5" />
                </button>
                @endif
            </div>
        </li>
        @empty
        <li class="flex items-center justify-center bg-indigo-400 rounded-md" style="min-height: 45px;">
            <span class="text-sm uppercase text-white font-semibold ">{{ $this->EmptyMessage }}</span>
        </li>
        @endforelse
    </ul>

    <!-- itemsNotInList -->
    @if($search && ! $this->ItemsNotInList->isEmpty())
    <h3 class="uppercase font-medium text-sm mt-4">Items from other lists</h3>

    <ul class="space-y-1 mt-1 pb-16" wire:loading.class="opacity-50">
        @foreach ($this->ItemsNotInList as $item)
        <li wire:key="item-{{ $item->id }}" class="bg-gray-100 flex items-center p-2 gap-3 shadow-md rounded-md">

            <input wire:click="checkItem({{$item->id}})" type="checkbox" id="item-have-{{ $item->id }}" name="have"
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   {{ $item->have ? 'checked' : '' }}>

            <h4 class="flex-grow text-lg truncate">{{ $item->name }}</h4>

            <div class="{{ $item->isOnList($activeList) ? 'text-gray-400' : 'text-red-300' }} flex items-center gap-3">
                <button wire:click="$emit('editItem', '{{ $item->id }}')" wire:loading.attr="disabled" wire:loading.class="opacity-50">
                    <x-svg.edit class="h-5 w-5" />
                </button>
            </div>
        </li>
        @endforeach
    </ul>
    @endif

    @push('modals')
    <livewire:items.add-item-modal :shoppingList="$activeList" />
    @endpush
</div>
