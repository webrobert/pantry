<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 mt-4">
            <livewire:shopping-list />
        </div>
</x-app-layout>
