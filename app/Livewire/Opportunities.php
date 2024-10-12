<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Opportunities extends Component
{
    use WithPagination;
    #[Validate('required')]
    public $perPage = 20; // Default number of items per page
    public $options = [20, 50, 100, 250]; // Options for items per page
    protected $queryString = ['perPage']; // Keep perPage in the URL

    
    public $searchText = '';
    public $results = [];

    public function updatedSearchText($value){
        $this->reset('results');

        $this->validate();

        $searchTerm = "%{$value}%";

        $this->results = Item::where('name', 'LIKE', $searchTerm)->get();
    }

    public function clear(){
        $this->reset('results', 'searchText');
    }

    public function updatingPerPage()
    { 
        $this->resetPage();
    }


    public function render()
    {
        $items = Item::with([])
            ->paginate($this->perPage);
        
        
        return view('livewire.opportunities', [
                                                'items' => $items,
                                                'options' => $this->options,
                                            ]);
    }
}
