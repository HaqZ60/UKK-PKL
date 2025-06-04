<?php

namespace App\Livewire\Pkl;

use Livewire\Component;
use App\Models\Guru;
use App\Models\Industri;
use App\Models\PKL;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class Form extends Component
{
    public $id, $industri_id, $guru_id, $mulai, $selesai;
    public $industriList = [];
    public $guruList = [];
    public $currentSiswa;

    public function mount($id = null)
    {
        // Get current student by email
        $this->currentSiswa = Siswa::where('email', Auth::user()->email)->first();
        
        if (!$this->currentSiswa) {
            session()->flash('error', 'Data siswa tidak ditemukan.');
            return redirect()->route('pkl');
        }

        // Check if student already has PKL record
        if (!$id && PKL::where('siswa_id', $this->currentSiswa->id)->exists()) {
            session()->flash('error', 'Anda sudah memiliki laporan PKL.');
            return redirect()->route('pkl');
        }

        $this->industriList = Industri::all();
        $this->guruList = Guru::all();

        // Load existing PKL data for edit mode
        if ($id) {
            $pkl = PKL::where('id', $id)
                     ->where('siswa_id', $this->currentSiswa->id)
                     ->firstOrFail();
            
            $this->id = $pkl->id;
            $this->industri_id = $pkl->industri_id;
            $this->guru_id = $pkl->guru_id;
            $this->mulai = $pkl->mulai;
            $this->selesai = $pkl->selesai;
        }
    }

    /**
     * Auto-calculate end date when start date is entered (3 months later as suggestion)
     */
    public function updatedMulai()
    {
        if ($this->mulai) {
            $startDate = \Carbon\Carbon::parse($this->mulai);
            $endDate = $startDate->copy()->addMonths(3);
            $this->selesai = $endDate->format('Y-m-d');
        }
    }

    /**
     * Custom validation messages
     */
    protected function messages()
    {
        return [
            'industri_id.required' => 'Industri tujuan harus dipilih.',
            'industri_id.exists' => 'Industri yang dipilih tidak valid.',
            'guru_id.required' => 'Guru pembimbing harus dipilih.',
            'guru_id.exists' => 'Guru yang dipilih tidak valid.',
            'mulai.required' => 'Tanggal mulai harus diisi.',
            'mulai.date' => 'Format tanggal mulai tidak valid.',
            'selesai.required' => 'Tanggal selesai harus diisi.',
            'selesai.date' => 'Format tanggal selesai tidak valid.',
            'selesai.after' => 'Tanggal selesai harus setelah tanggal mulai.',
        ];
    }

    /**
     * Custom validation rules with PKL duration check
     */
    public function rules()
    {
        return [
            'industri_id' => 'required|exists:industri,id',
            'guru_id' => 'required|exists:guru,id',
            'mulai' => 'required|date',
            'selesai' => [
                'required',
                'date',
                'after:mulai',
                function ($attribute, $value, $fail) {
                    if ($this->mulai && $value) {
                        $startDate = \Carbon\Carbon::parse($this->mulai);
                        $endDate = \Carbon\Carbon::parse($value);
                        
                        // Calculate the difference in months
                        $diffInMonths = $startDate->diffInMonths($endDate);
                        
                        // PKL duration must be exactly 3 months
                        if ($diffInMonths < 3) {
                            $fail('Durasi PKL minimal 3 bulan.');
                        } elseif ($diffInMonths > 3) {
                            $fail('Durasi PKL maksimal 3 bulan.');
                        }
                        
                        // Additional check: ensure it's approximately 3 months (90-93 days)
                        $diffInDays = $startDate->diffInDays($endDate);
                        if ($diffInDays < 85 || $diffInDays > 95) {
                            $fail('Durasi PKL harus sekitar 3 bulan (85-95 hari).');
                        }
                    }
                }
            ],
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'siswa_id' => $this->currentSiswa->id,
            'industri_id' => $this->industri_id,
            'guru_id' => $this->guru_id,
            'mulai' => $this->mulai,
            'selesai' => $this->selesai,
        ];

        if ($this->id) {
            PKL::where('id', $this->id)->update($data);
            session()->flash('message', 'Laporan PKL berhasil diperbarui.');
        } else {
            PKL::create($data);
            session()->flash('message', 'Laporan PKL berhasil disimpan.');
        }

        return redirect()->route('pkl');
    }

    public function render()
    {
        return view('livewire.pkl.form');
    }
}
