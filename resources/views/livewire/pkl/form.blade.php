<div class="p-6 max-w-3xl mx-auto bg-orange-200 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6 text-center">
        {{ $id ? 'Edit Laporan' : 'Lapor PKL' }}
    </h2>

    <!-- PKL Duration Info -->
    <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-6">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="text-sm text-blue-800">
                <strong>Informasi PKL:</strong> Durasi PKL minimal 3 bulan (90 hari). Tanggal selesai akan otomatis terisi sebagai saran saat Anda memilih tanggal mulai, tetapi Anda dapat mengubahnya sesuai kebutuhan.
            </div>
        </div>
    </div>

    <!-- Display Flash Messages -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Nama Siswa (Read-only) -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                <input type="text" value="{{ $currentSiswa->nama }}" disabled 
                       class="w-full mt-1 border bg-gray-100 border-gray-300 rounded-md px-4 py-2 text-gray-600 cursor-not-allowed">
                <p class="text-xs text-gray-500 mt-1">NIS: {{ $currentSiswa->nis }}</p>
            </div>

            <!-- Industri Tujuan -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Industri Tujuan</label>
                <select wire:model="industri_id" class="w-full mt-1 border bg-yellow-700 border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih industri tujuan anda</option>
                    @foreach($industriList as $industri)
                        <option value="{{ $industri->id }}">{{ $industri->nama }}</option>
                    @endforeach
                </select>
                @error('industri_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Guru Pembimbing -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Guru Pembimbing</label>
                <select wire:model="guru_id" class="w-full mt-1 border bg-yellow-700 border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih guru pembimbing yang sesuai</option>
                    @foreach($guruList as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                    @endforeach
                </select>
                @error('guru_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Tanggal Mulai -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Mulai PKL</label>
                <input type="date" wire:model.live="mulai" class="w-full mt-1 bg-yellow-700 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-500 mt-1">Pilih tanggal mulai PKL</p>
                @error('mulai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Tanggal Selesai -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Selesai PKL</label>
                <input type="date" wire:model="selesai" class="w-full mt-1 border bg-yellow-700 border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" {{ $mulai ? 'readonly' : '' }}>
                <p class="text-xs text-gray-500 mt-1">
                    @if($mulai && $selesai)
                        Durasi: {{ \Carbon\Carbon::parse($mulai)->diffInDays(\Carbon\Carbon::parse($selesai)) }} hari ({{ \Carbon\Carbon::parse($mulai)->diffInMonths(\Carbon\Carbon::parse($selesai)) }} bulan)
                    @else
                        Otomatis terisi 3 bulan dari tanggal mulai
                    @endif
                </p>
                @error('selesai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex justify-between pt-4">
            <a href="{{ route('pkl') }}" class="bg-gray-500 text-white px-6 py-3 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition">
                Batal
            </a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
