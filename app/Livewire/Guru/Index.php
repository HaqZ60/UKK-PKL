<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Guru;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // Property pencarian
    public $search;

    // Mereset halaman saat melakukan pencarian
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Menghapus data guru berdasarkan ID
    public function delete($id)
    {
        Guru::findOrFail($id)->delete();
        session()->flash('message', 'Data guru berhasil dihapus.');
    }

    // Konversi gender
    public function ketGender($gender)
    {
        if ($gender === 'L') {
            return 'Laki-laki';
        } elseif ($gender === 'P') {
            return 'Perempuan';
        } else {
            return 'Status tidak diketahui';
        }
    }

    // Render data ke view
    public function render()
    {
        $query = Guru::query();

        if (!empty($this->search)) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('nip', 'like', '%' . $this->search . '%');
        }

        $guruList = $query->paginate(10); // gunakan paginate agar fitur pagination berfungsi

        return view('livewire.guru.index', [
            'guruList' => $guruList,
        ]);
    }
}
