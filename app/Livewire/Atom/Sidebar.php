<?php

namespace App\Livewire\Atom;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Sidebar extends Component
{
    public $user;
    public $currentRoute;
    
    protected $listeners = ['profileUpdated' => 'refreshSidebar'];

    public function mount()
    {
        $this->refreshSidebar();
    }

    public function refreshSidebar()
    {
        $this->user         = Auth::user();
        $this->currentRoute = Route::currentRouteName();
    }

    public function render()
    {
        return view('livewire.atom.sidebar');
    }
}
