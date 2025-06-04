<div class="p-6 bg-[#FFF8E7] min-h-screen">
    <div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
        <a href="{{ route('industri.create') }}" class="bg-black text-[#FFF8E7] px-6 py-3 rounded-md hover:bg-[#333] transition duration-200 font-semibold shadow">
            Tambah Industri
        </a>
        <div class="flex items-center space-x-2">
            <label for="search" class="text-sm font-medium text-black">Search:</label>
            <input wire:model.live="search" id="search" type="text" placeholder="Search industri..." class="w-full md:w-72 px-4 py-2 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-black transition duration-150 bg-[#FFF8E7] text-black placeholder-gray-500">
        </div>
    </div>
    @if (session()->has('message'))
        <div class="bg-yellow-100 text-black p-2 mb-4 rounded text-center border border-yellow-300">
            {{ session('message') }}
        </div>
    @endif
    <div class="overflow-x-auto bg-[#FFF3D6] shadow rounded-lg border border-black">
        <table class="min-w-full text-sm text-left text-black">
            <thead class="text-xs uppercase bg-[#F5E6C8] border-b border-black">
                <tr>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Bidang Usaha</th>
                    <th class="px-6 py-3">Alamat</th>
                    <th class="px-6 py-3">Kontak</th>
                    <th class="px-6 py-3">Guru Pembimbing</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($industri as $industri)
                <tr class="border-b border-black hover:bg-[#F5E6C8] bg-[#FFF8E7]">
                    <td class="px-6 py-3">{{ $industri->nama }}</td>
                    <td class="px-6 py-3">{{ \Illuminate\Support\Str::limit($industri->bidang_usaha, 25) }}</td>
                    <td class="px-6 py-3">{{ \Illuminate\Support\Str::limit($industri->alamat, 25) }}</td>
                    <td class="px-6 py-3">{{ $industri->kontak }}</td>
                    <td class="px-6 py-3">
                        @if ($industri->guru)
                            {{ $industri->guru->nama }}
                        @else
                            <em class="text-gray-500">{{ __('Guru Pembimbing Tidak Ditemukan') }}</em>
                        @endif
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div x-data="{ open: false }" class="relative inline-block text-left">
                            <button @click="open = !open" class="text-black hover:text-[#333] focus:outline-none transition duration-200">
                                &#8942;
                            </button>
                            <div x-show="open" x-transition @click.away="open = false"
                                class="absolute right-0 mt-2 w-36 bg-[#FFF3D6] border border-black rounded shadow z-50">
                                <a href="{{ route('industri.show', ['id' => $industri->id]) }}"
                                   class="block px-4 py-2 text-sm text-black hover:bg-[#F5E6C8] transition duration-150">View</a>
                                <a href="{{ route('industri.edit', ['id' => $industri->id]) }}"
                                   class="block px-4 py-2 text-sm text-black hover:bg-[#F5E6C8] transition duration-150">Edit</a>
                                <button wire:click="delete({{ $industri->id }})"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-[#F5E6C8] transition duration-150">Hapus</button>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
