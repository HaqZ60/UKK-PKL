<?php

namespace App\Livewire\Pkl;

use Livewire\Component;
use App\Models\PKL;
use App\Models\Siswa;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public $numpage = 10;
    public $search;
    public $currentSiswa;

    public function mount()
    {
        $this->currentSiswa = Siswa::where('email', Auth::user()->email)->first();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        // Only allow deletion of own PKL records
        PKL::where('id', $id)
           ->where('siswa_id', $this->currentSiswa->id)
           ->firstOrFail()
           ->delete();
           
        session()->flash('message', 'Data PKL berhasil dihapus.');
    }

    public function render()
    {
        $query = PKL::with(['siswa', 'industri', 'guru'])
                    ->where('siswa_id', $this->currentSiswa->id);

        if (!empty($this->search)) {
            $query->whereHas('industri', function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('guru', function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%');
            });
        }

        $pklList = $query->paginate($this->numpage);

        return view('livewire.pkl.index', [
            'pklList' => $pklList,
        ]);
    }
}
