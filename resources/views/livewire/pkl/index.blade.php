<div class="p-6 bg-[#fdf6f0] min-h-screen">
    <div class="relative mb-6 w-full grid grid-cols-12 gap-4">
        <div class="col-span-12 md:col-span-6 flex justify-start items-center">
            <a href="{{ route('pkl.create') }}"
               class="bg-black text-[#fdf6f0] px-6 py-3 rounded-md hover:bg-gray-800 transition duration-200 shadow-md">
                Tambah Laporan PKL
            </a>
        </div>
        <div class="col-span-12 md:col-span-6 flex justify-between items-center space-x-4">
            <div class="flex items-center space-x-2">
                <label for="search" class="text-sm font-semibold text-black">Search:</label>
                <input wire:model.live="search" id="search" type="text" placeholder="Cari siswa..."
                       class="w-full md:w-72 px-4 py-2 border border-black text-black bg-[#fffaf5] rounded-lg focus:outline-none focus:ring-2 focus:ring-black transition duration-150 ease-in-out">
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-yellow-100 text-black p-3 mb-4 rounded text-center shadow">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg border border-black">
        <table class="w-full text-sm text-left text-black">
            <thead class="text-xs uppercase bg-black text-[#fdf6f0]">
                <tr>
                    <th class="px-6 py-3">Nama Siswa</th>
                    <th class="px-6 py-3">Nama Industri</th>
                    <th class="px-6 py-3">Guru Pembimbing</th>
                    <th class="px-6 py-3">Tanggal Masuk</th>
                    <th class="px-6 py-3">Tanggal Keluar</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($pklList && $pklList->count())
                    @foreach ($pklList as $pkl)
                        <tr class="border-b hover:bg-[#f8e8d8] transition duration-200">
                            <td class="px-6 py-3">{{ $pkl->siswa ? $pkl->siswa->nama : 'Tidak ada siswa' }}</td>
                            <td class="px-6 py-3">{{ $pkl->industri ? $pkl->industri->nama : 'Tidak ada industri' }}</td>
                            <td class="px-6 py-3">{{ $pkl->guru ? $pkl->guru->nama : 'Tidak ada guru' }}</td>
                            <td class="px-6 py-3">{{ $pkl->mulai }}</td>
                            <td class="px-6 py-3">{{ $pkl->selesai }}</td>
                            <td class="px-6 py-3 text-center relative">
                                <div x-data="{ open: false }" class="inline-block text-left">
                                    <button @click="open = !open" class="text-black hover:text-gray-800 focus:outline-none">
                                        &#8942;
                                    </button>
                                    <div x-show="open" x-transition @click.away="open = false"
                                         class="absolute right-0 mt-2 w-40 bg-white border border-black rounded shadow-lg z-50">
                                        <a href="{{ route('pkl.show', ['id' => $pkl->id]) }}"
                                           class="block px-4 py-2 text-sm text-black hover:bg-[#f3e6d0]">Lihat</a>
                                        <a href="{{ route('pkl.edit', ['id' => $pkl->id]) }}"
                                           class="block px-4 py-2 text-sm text-blue-600 hover:bg-[#f3e6d0]">Edit</a>
                                        <button wire:click="delete({{ $pkl->id }})"
                                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-[#f3e6d0]">Hapus</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center py-4 text-black">Tidak ada data ditemukan.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="my-6">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <label for="perPage" class="text-sm font-medium text-black">Tampilkan:</label>
                <select wire:model="numpage" wire:change="updatePageSize($event.target.value)"
                        id="perPage"
                        class="px-3 py-2 border border-black text-black bg-white rounded-md">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="{{ $pklList->total() }}">Semua</option>
                </select>
                <span class="text-sm text-black">data per halaman</span>
            </div>

            <div class="flex justify-end">
                {{ $pklList->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</div>
