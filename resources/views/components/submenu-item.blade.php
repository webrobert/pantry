<button {{ $attributes }} wire:loading.attr="disabled" wire:loading.class="opacity-50" class="flex items-center {{ $isActive ?: 'text-gray-400'}}">
        {{ $icon }}
    <span class="hidden md:inline-block ml-1 uppercase text-sm border-dotted border-b-2 border-white">
        {{ $label }}
    </span>
</button>
