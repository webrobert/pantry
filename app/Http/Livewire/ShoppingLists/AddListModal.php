<?php

namespace App\Http\Livewire\ShoppingLists;

use App\Models\ShoppingList;
use Livewire\Component;

class AddListModal extends Component
{
	public $showListModal;
    public $list;

    protected $listeners = [
        'editShoppingList' => 'edit',
        'createItemFromSearch' => 'create'
    ];

	protected $rules = [
		'list.name' => 'required',
	];

    public function mount()
    {
        $this->list = new ShoppingList();
    }

    public function create($name = null)
    {
        $this->list = new ShoppingList();
        $this->list->fill(['name' => $name]);

        $this->showListModal = true;
    }

	public function edit($id)
	{
		$this->list = ShoppingList::find($id);

		$this->showListModal = true;
	}

    public function delete()
    {
        $this->list->delete();

        $this->emit('listDeleted');
	    $this->showListModal = false;
    }

    public function save() {
	    $this->validate();
	    $this->list->save();

	    if ($this->list->wasRecentlyCreated) {
		    return redirect()->route('shoppingLists.show', $this->list->id);
	    }

	    $this->emit( 'shoppingListSaved', $this->list );
	    $this->showListModal = false;
    }

    public function render()
    {
        return view('shopping-lists.add-shopping-list-modal');
    }
}
