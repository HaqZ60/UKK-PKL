<?php

namespace App\Livewire\Industri;

use App\Models\Industri;
use Livewire\WithPagination;
use Livewire\Component;

class Index extends Component
{
    use WithPagination;

    public $numpage = 10;
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        Industri::findOrFail($id)->delete();
        session()->flash('message', 'Data industri berhasil dihapus.');
    }

    public function render()
    {
        $query = Industri::query();

        if (!empty($this->search)) {
            $query->join('guru', 'industri.guru_pembimbing', '=', 'guru.id')
                  ->where(function($q) {
                      $q->where('industri.nama', 'like', '%' . $this->search . '%')
                        ->orWhere('guru.nama', 'like', '%' . $this->search . '%');
                  });
        }

        $industri = $query->select('industri.*')->paginate($this->numpage);

        return view('livewire.industri.index', [
            'industri' => $industri,
        ]);
    }
}
