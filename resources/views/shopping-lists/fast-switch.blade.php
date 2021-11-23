<x-jet-dropdown align="left">
    <x-slot name="trigger">
        <h2 class="text-xl flex items-center">
            <span>{{ $activeList->name ?? 'All items' }}</span>
            <x-svg.chevron-down class="h-5 w-5 ml-1 text-gray-400" />
        </h2>
    </x-slot>

    <x-slot name="content">
        <div>
            <x-jet-dropdown-link wire:click="chooseStore()">All items</x-jet-dropdown-link>
            @foreach($shoppingLists as $store)
                <x-jet-dropdown-link wire:click="chooseStore('{{ $store->id }}')">{{ $store->name }}</x-jet-dropdown-link>
            @endforeach
        </div>
    </x-slot>
</x-jet-dropdown>
