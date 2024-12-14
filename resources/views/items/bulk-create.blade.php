<div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 pt-4"
     wire:loading.class="opacity-50" wire:target="changeList">

    <div class="flex flex-col">
        <textarea wire:model.defer="items" rows="5" class="w-full border rounded-md"></textarea>
        <button wire:click="save">Save</button>
    </div>

</div>