<div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 pt-4" wire:loading.class="opacity-50" wire:target="changeList">

    <!-- Shopping List Top Navigation -->
    <div class="block flex items-center gap-3">

        @include('shopping-lists.fast-switch-title')

        <div class="flex gap-3 uppercase ml-auto items-center">
            <button wire:click="$set('showHave', false)" wire:loading.attr="disabled" wire:loading.class="opacity-50"
                    class="flex items-center {{ ! $showHave ?: 'text-gray-400'}}">
                <x-svg.shopping-cart class="h-6 w-6"  />
                <span class="hidden md:inline-block ml-1 uppercase text-sm
                             border-dotted border-b-2 border-white">Shop</span>
            </button>

            <button wire:click="$set('showHave', true)" wire:loading.attr="disabled" wire:loading.class="opacity-50"
                    class="flex items-center mt-0.5 {{ $showHave ?: 'text-gray-400'}}">
                <x-svg.potion class="h-6 w-6" />
                <span class="hidden md:inline-block ml-1 uppercase text-sm
                             border-dotted border-b-2 border-white">Manage</span>
            </button>
        </div>

    </div>

    @include('components.search-filter')

    <!-- items -->
    <ul wire:sortable="updateItemOrder" wire:loading.class="opacity-50" wire:target="changeList" class="space-y-1 mt-4">
        @forelse($this->Items as $item)
        <li @if($activeList && $showHave)
            wire:sortable.item="{{ $item->id }}"
            wire:sortable.options="{ }"
            @endif
            wire:key="item-{{ $item->id }}"
            class="bg-white flex items-center p-2 gap-2 shadow-md rounded-md">

            <label class="-m-2 flex-none p-2 px-3 flex items-center">
                <input type="checkbox" id="item-have-{{ $item->id }}" name="have" wire:click="checkItem({{$item->id}})" {{ $item->have ? 'checked' : '' }}
                       class="h-5 w-5 rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </label>

            <h4 class="flex-grow text-lg truncate">{{ $item->name }}</h4>

            <div class="text-gray-400 flex items-center gap-3">
                <button wire:sortable.handle
                        class="{{ $activeList && $showHave ? '-m-2 flex-none p-2 px-3 flex items-center pr-4' : 'hidden' }}">
                    <x-svg.selector class="h-5 w-5 transform active:scale-110" />
                </button>

                <button wire:click="$emit('editItem', '{{ $item->id }}')" wire:loading.attr="disabled" wire:loading.class="opacity-50"
                        class="-m-2 flex-none p-2 px-3 flex items-center transform focus:scale-95 opacity-75">
                    <x-svg.edit class="h-6 w-6" />
                </button>
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
