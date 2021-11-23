<?php

namespace App\Http\Livewire\ShoppingLists;

use App\Models\ShoppingList;
use Livewire\Component;

class AddListModal extends Component
{
    public $store;
    public $showStoreModal = false;

    protected $listeners = ['editShoppingList' => 'edit'];

    public function mount()
    {
        $this->store = new ShoppingList();
    }

    protected function rules()
    {
        return [
            'store.name' => 'required',
        ];
    }

    public function create()
    {
        $this->store = new ShoppingList();
        $this->showStoreModal = true;
    }

    public function delete()
    {
        $this->store->delete();

        $this->showStoreModal = false;

        $this->emit('listDeleted');
    }

    public function edit($id)
    {
        $this->store = ShoppingList::find($id);
        $this->showStoreModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->store->save();

        if($this->store->wasRecentlyCreated) {
            return redirect()->route('shoppingLists.show', $this->store->id);
        }

        $this->showStoreModal = false;

        $this->emit('shoppingListSaved', $this->store);
    }


    public function render()
    {
        return view('shopping-lists.add-shopping-list-modal');
    }
}
