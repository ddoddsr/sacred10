<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public $perPage = 8;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;
    public $active = true;

    public function render()
    {
        // tuck this away as a query scope on the model??
        return view('livewire.users-table',[
            'users' => User::search($this->search)
            ->where('active' , $this->active )
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->simplePaginate($this->perPage),  // just prev & next buttons
            // ->paginate($this->perPage),
        ]);
    }

    public function edit($user) {
        dump("STUB of: open view of edit model $user ");
        // dd($user);
    }
}
