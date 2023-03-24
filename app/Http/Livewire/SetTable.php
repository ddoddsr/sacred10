<?php

namespace App\Http\Livewire;

use App\Models\Set;
use Livewire\Component;
use Livewire\WithPagination;

class SetTable extends Component
{
    use WithPagination;

    public $active = true;
    public $search;
    public $sortField;
    public $sortAsc = true;
    protected $queryString = ['search', 'active', 'sortAsc', 'sortField'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.set-table', [
            'sets' => Set::all()
            // ->where(function ($query) {
            //     $query->where('dayOfWeek', 'like', '%' . $this->search . '%')
            //         ->orWhere('setOfDay', 'like', '%' . $this->search . '%');
            // })

            // // ->where('active', $this->active)
            // ->when($this->sortField, function ($query) {
            //     $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
            // })
            // ->paginate(10),
            // ->simplePaginate(12)
        ]);
    }

    // public function paginationView()
    // {
    //     return 'livewire.custom-pagination-links-view';
    // }
}
