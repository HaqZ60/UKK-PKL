<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\siswa;

class siswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswatRole = Role::firstOrCreate(['name' => 'siswa']);

        siswa::create([
            'nama' => 'yanto', // ambil dari user
            'nis' => '20334',
            'gender' => 'L',
            'alamat' => 'Jl. Pendidikan No. 12',
            'kontak' => '08123456789',
            'email' => 'yanto@gmail.com',
        ]);
    }
}
