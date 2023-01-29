@props(['item'])
<li {{ $attributes->merge(['class' => 'bg-white flex items-center p-2 gap-2 shadow-md rounded-md']) }}>

    <label class="-m-2 flex-none p-2 px-3 flex items-center">
        {{ $checkbox }}
    </label>

    <h4 class="flex-grow text-lg truncate">{{ $name }}</h4>

    <div class="flex items-center gap-3 text-gray-400">
{{--        <button wire:sortable.handle--}}
{{--                class="{{ $activeList && $showHave ? '-m-2 flex-none p-2 px-3 flex items-center pr-4' : 'hidden' }}">--}}
{{--            <x-svg.selector class="h-5 w-5 transform active:scale-110" />--}}
{{--        </button>--}}

        <button wire:click="$emit('editItem', '{{ $item->id }}')"
                wire:loading.attr="disabled" wire:loading.class="opacity-50"
                class="-m-2 flex-none p-2 px-3 flex items-center transform focus:scale-95 opacity-75">
            <x-svg.ellipsis />
        </button>
    </div>
</li>