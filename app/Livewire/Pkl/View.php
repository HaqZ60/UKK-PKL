<?php

namespace App\Livewire\Pkl;

use Livewire\Component;
use App\Models\PKL;

class View extends Component
{
    public $pkl;

    public function mount($id)
    {
        $this->pkl = PKL::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.pkl.view');
    }

}