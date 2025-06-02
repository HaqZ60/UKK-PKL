<div class="p-6 max-w-3xl mx-auto bg-gray-400 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6 text-center">{{ $id ? 'Edit Siswa' : 'Tambah Siswa' }}</h2>

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-6">
        <!-- Nama -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" wire:model="nama" class="w-full border border-gray-300 rounded-md px-4 py-2 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- NIS -->
        <div>
            <label class="block text-sm font-medium text-gray-700">NIS</label>
            <input type="text" wire:model="nis" class="w-full border border-gray-300 rounded-md px-4 py-2 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('nis') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Gender -->
        <div class="flex flex-col gap-2">
            <label class="inline-flex items-center">
                <input type="radio" wire:model="gender" value="L" class="form-radio text-blue-600" />
                <span class="ml-2">Laki Laki</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" wire:model="gender" value="P" class="form-radio text-blue-600" />
                <span class="ml-2">Perempuan</span>
            </label>
        </div>


        <!-- Alamat -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Alamat</label>
            <textarea wire:model="alamat" class="w-full border border-gray-300 rounded-md px-4 py-2 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="2"></textarea>
            @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Kontak -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Kontak</label>
            <input type="text" wire:model="kontak" class="w-full border border-gray-300 rounded-md px-4 py-2 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('kontak') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" wire:model="email" class="w-full border border-gray-300 rounded-md px-4 py-2 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Foto -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Foto</label>
            <input type="file" wire:model="foto" class="w-full border border-gray-300 rounded-md px-4 py-2 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            @error('foto') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if ($existingFoto)
                <div class="mt-2">
                    <p class="text-sm text-gray-600">Current Photo:</p>
                    <img src="{{ asset('storage/' . $existingFoto) }}" alt="Current photo" class="mt-1 h-20 w-20 object-cover rounded">
                </div>
            @endif
        </div>

        <!-- Status PKL -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 my-2">Status PKL</label>
            <div class="mt-2">
                <label class="inline-flex items-center">
                    <input type="radio" wire:model="status_pkl" value="0" class="form-radio text-blue-600" />
                    <span class="ml-2">Belum diterima PKL</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" wire:model="status_pkl" value="1" class="form-radio text-blue-600" />
                    <span class="ml-2">Sudah diterima PKL</span>
                </label>
            </div>
            @error('status_pkl') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-between">
            <!-- Cancel Button -->
            <a href="{{ route('siswa') }}" class="inline-block bg-gray-500 text-white px-6 py-3 rounded-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200">
                Cancel
            </a>

            <!-- Submit Button -->
            <button type="submit" class="bg-gray-500 cursor-pointer text-white px-6 py-3 rounded-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200">
                Simpan
            </button>
        </div>
    </form>
</div>
