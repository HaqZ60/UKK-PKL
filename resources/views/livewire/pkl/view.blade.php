<div class="max-w-4xl mx-auto bg-yellow-200 shadow-lg rounded-lg p-6 mt-10">
    <!-- Informasi PKL -->
    <div class="grid grid-cols-2 gap-6">
        <!-- Siswa & Guru Pembimbing -->
        <div class="bg-yellow-50 p-4 rounded-lg shadow-sm">
            <h3 class="font-semibold text-lg text-black">Nama Siswa</h3>
            <p class="text-black mt-2">{{ $pkl->siswa ? $pkl->siswa->nama : 'Tidak ada siswa' }}</p>
        </div>
        <div class="bg-yellow-50 p-4 rounded-lg shadow-sm">
            <h3 class="font-semibold text-lg text-black">Guru Pembimbing</h3>
            <p class="text-black mt-2">{{ $pkl->guru ? $pkl->guru->nama : 'Tidak ada siswa' }}</p>
        </div>

        <!-- Industri & Bidang Usaha -->
        <div class="bg-yellow-50 p-4 rounded-lg shadow-sm">
            <h3 class="font-semibold text-lg text-black">Industri</h3>
            <p class="text-black mt-2">{{ $pkl->industri ? $pkl->industri->nama : 'Tidak ada industri' }}</p>
        </div>
        <div class="bg-yellow-50 p-4 rounded-lg shadow-sm">
            <h3 class="font-semibold text-lg text-black">Bidang Usaha</h3>
            <p class="text-black mt-2">{{ $pkl->industri ? $pkl->industri->bidang_usaha : 'Tidak ada bidang usaha' }}</p>
        </div>

        <!-- Tanggal Mulai & Selesai -->
        <div class="bg-yellow-50 p-4 rounded-lg shadow-sm">
            <h3 class="font-semibold text-lg text-black">Tanggal Mulai</h3>
            <p class="text-black mt-2">{{ $pkl->mulai }}</p>
        </div>
        <div class="bg-yellow-50 p-4 rounded-lg shadow-sm">
            <h3 class="font-semibold text-lg text-black">Tanggal Selesai</h3>
            <p class="text-black mt-2">{{ $pkl->selesai }}</p>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center mt-8">
        <a href="{{ route('pkl') }}"
           class="inline-block bg-black text-white px-6 py-3 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200">
            Kembali
        </a>
    </div>
</div>
