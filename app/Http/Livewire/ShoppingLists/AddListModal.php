<?php

namespace App\Http\Livewire\ShoppingLists;

use App\Models\ShoppingList;
use Livewire\Component;

class AddListModal extends Component
{
    public $list;
    public $showListModal = false;

    protected $listeners = [
        'editShoppingList' => 'edit',
        'createItemFromSearch' => 'create'
    ];

    public function mount()
    {
        $this->list = new ShoppingList();
    }

    protected function rules()
    {
        return [
            'list.name' => 'required',
        ];
    }

    public function create($name = null)
    {
        $this->list = new ShoppingList();
        $this->list->fill(['name' => $name]);
        $this->showListModal = true;
    }

    public function delete()
    {
        $this->list->delete();

        $this->showListModal = false;

        $this->emit('listDeleted');
    }

    public function edit($id)
    {
        $this->list = ShoppingList::find($id);
        $this->showListModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->list->save();

        if($this->list->wasRecentlyCreated) {
            return redirect()->route('shoppingLists.show', $this->list->id);
        }

        $this->showListModal = false;

        $this->emit('shoppingListSaved', $this->list);
    }


    public function render()
    {
        return view('shopping-lists.add-shopping-list-modal');
    }
}
