<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\Siswa;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // Deklarasi variabel numpage dan search
    public $numpage = 10;
    public $search;

    // Reset halaman setelah search
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Menghapus data
    public function delete($id)
    {
        Siswa::findOrFail($id)->delete();
        session()->flash('message', 'Data siswa berhasil dihapus.');
    }

    // Method untuk render keseluruhan
    public function render()
    {
        // Ambil query, logika search query
        $query = Siswa::query();

        if (!empty($this->search)) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('nis', 'like', '%' . $this->search . '%');
        }

        $siswaList = $query->paginate($this->numpage);

        return view('livewire.siswa.index', [
            'siswaList' => $siswaList,
        ]);
    }

    // Update ukuran halaman (dengan filter tampilan data)
    public function updatePageSize($size)
    {
        $this->numpage = $size;
    }

    // Function gender
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

    // Function Status PKL
    public function ketStatusPKL($status)
    {
        if ($status === 0) {
            return 'Belum diterima PKL';
        } elseif ($status === 1) {
            return 'Sudah diterima PKL';
        } else {
            return 'Status tidak diketahui';
        }
    }
}
