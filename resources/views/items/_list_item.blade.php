@php($key ?? 'item')
<li wire:key="{{ $key }}-{{ $item->id }}"
    @if($activeList && $show === 'manage') wire:sortable.item="{{ $item->id }}" wire:sortable.options="{ }" @endif
    class="bg-white flex items-center p-2 gap-2 shadow-md rounded-md">

        @if($key == 'item')
        <label class="-m-2 flex-none p-2 px-3 flex items-center"
               @click="handleOnClick($event, $wire, {{ $item->id }})"
               @mousedown="handleOnMouseDown"
               @mouseup="handleOnMouseUp"
               @touchstart="handleOnTouchStart"
               @touchend="handleOnTouchEnd"
               >
            <x-checkbox :checked="$item->have"/>
        </label>
    @else
        <label class="-m-2 flex-none p-2 px-3 flex items-center">
            <x-checkbox wire:click="checkItem({{ $item->id }})"
            :checked="$item->have" />
        </label>
    @endif

    <h4 class="flex-grow text-lg truncate">
            {{ $item->name }}
        @if($item->quantity > 1)
            <span class="text-gray-500">({{ $item->quantity }})</span>
        @endif
    </h4>

    <div class="text-gray-400 flex items-center gap-3">

        @if($key == 'item')
        <button wire:sortable.handle
                class="{{ $activeList && $show === 'manage' ? '-m-2 flex-none p-2 px-3 flex items-center pr-4' : 'hidden' }}">
            <x-svg.selector class="h-5 w-5 transform active:scale-110" />
        </button>
        @endif

        <button wire:click="$emit('editItem', '{{ $item->id }}')"
                wire:loading.attr="disabled" wire:loading.class="opacity-50"
                class="-m-2 flex-none p-2 px-3 flex items-center transform focus:scale-95 opacity-75">
            <x-svg.ellipsis />
        </button>
    </div>
</li>