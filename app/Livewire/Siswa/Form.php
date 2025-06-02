<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\Siswa;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $id, $nama, $nis, $gender, $alamat, $kontak, $email, $foto, $existingFoto, $status_pkl;

    public function mount($id = null)
    {
        if ($id) {
            $siswa = Siswa::findOrFail($id);
            $this->id = $siswa->id;
            $this->nama = $siswa->nama;
            $this->nis = $siswa->nis;
            $this->gender = $siswa->gender;
            $this->alamat = $siswa->alamat;
            $this->kontak = $siswa->kontak;
            $this->email = $siswa->email;
            $this->existingFoto = $siswa->foto;
            $this->status_pkl = $siswa->status_pkl;
        } else {
            // Set default values for new records
            $this->status_pkl = 0; // Default to "Belum diterima PKL"
        }
    }

    public function save()
    {
        $validationRules = [
            'nama' => 'required|string',
            'nis' => 'required|string',
            'gender' => 'required|string',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
            'email' => 'required|email',
            'status_pkl' => 'required',
        ];

        // Only require the photo for new records
        if ($this->id) {
            $validationRules['foto'] = 'nullable|image|max:1024';
        } else {
            $validationRules['foto'] = 'required|image|max:1024';
        }

        $this->validate($validationRules);

        $fotoPath = null;
        if ($this->foto) {
            $fotoPath = $this->foto->store('foto_siswa', 'public');
        } elseif ($this->existingFoto ?? false) {
            $fotoPath = $this->existingFoto;
        }

        try {
            Siswa::updateOrCreate(
                ['id' => $this->id],
                [
                    'nama' => $this->nama,
                    'nis' => $this->nis,
                    'gender' => $this->gender,
                    'alamat' => $this->alamat,
                    'kontak' => $this->kontak,
                    'email' => $this->email,
                    'foto' => $fotoPath,
                    'status_pkl' => $this->status_pkl,
                ]
            );

            session()->flash('message', 'Data siswa berhasil disimpan.');
            return redirect()->route('siswa');
        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.siswa.form');
    }
}
