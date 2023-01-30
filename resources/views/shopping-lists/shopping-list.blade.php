<div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 pt-4"
     wire:loading.class="opacity-50" wire:target="changeList">

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
    <ul wire:sortable="updateItemOrder"
        wire:loading.class="opacity-50"
        wire:target="changeList" class="space-y-1 mt-4" x-data>
        @forelse($this->Items as $item)
            @include('items._list_item', ['key' => 'item'])
        @empty
            <li class="flex items-center justify-center bg-indigo-400 rounded-md min-h-[45px]">
                <span class="text-sm uppercase text-white font-semibold">{{ $this->EmptyMessage }}</span>
            </li>
        @endforelse
    </ul>

    <!-- itemsNotInList -->
    @if($search && ! $this->ItemsNotInList->isEmpty())
    <h3 class="uppercase font-medium text-sm mt-4">Items from other lists</h3>

    <ul class="space-y-1 mt-1 pb-16" wire:loading.class="opacity-50">
        @foreach ($this->ItemsNotInList as $item)
            @include('items._list_item', ['key' => 'items-on-other-lists'])
        @endforeach
    </ul>
    @endif

    <script>
        let isLongPress;
        let timerRef;
        let action;

        function handleOnClick(e, wire, itemId) {
            if (isLongPress) {
                wire.buyLater(itemId);
                return;
            }
            wire.checkItem(itemId);
        }

        function handleOnMouseDown() { startPressTimer(); }
        function handleOnMouseUp() { clearTimeout(timerRef); }
        function handleOnTouchStart() { startPressTimer(); }

        function handleOnTouchEnd() {
            if ( action === 'longpress') return;
            clearTimeout(timerRef);
        }

        function startPressTimer() {
            isLongPress = false;
            timerRef = setTimeout(() => {
                isLongPress = true;
                action = 'longpress';
            }, 300)
        }
    </script>

    @push('modals')
    <livewire:items.add-item-modal :shoppingList="$activeList" />
    @endpush
</div>
