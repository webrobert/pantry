<x-jet-dropdown align="left">
    <x-slot name="trigger">
        <h2 class="text-xl flex items-center font-semibold cursor-pointer">
            <span>{{ $activeList->name ?? 'All items' }}</span>
            <x-svg.chevron-down class="h-5 w-5 ml-1 text-gray-400" />
        </h2>
    </x-slot>

    <x-slot name="content">
        <x-jet-dropdown-link :isActive="!$activeList" href="{{ route('items.index') }}" class="cursor-pointer">All items</x-jet-dropdown-link>
        @foreach($this->shoppingLists as $list)
        <x-jet-dropdown-link :isActive="$activeList?->id == $list->id" href="{{ route('shoppingLists.show', $list->id) }}" class="cursor-pointer">{{ $list->name }}</x-jet-dropdown-link>
        @endforeach
    </x-slot>
</x-jet-dropdown>
