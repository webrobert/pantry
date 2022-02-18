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
