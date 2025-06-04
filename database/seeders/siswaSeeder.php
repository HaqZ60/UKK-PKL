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
        $role = Role::where('name', 'student')->first();
        if (!$role) {
            $role = Role::create(['name' => 'student', 'guard_name' => 'web']);
        }

        $siswa = siswa::insert([
      [
            'nama' => 'Abu Bakar Tsabit Ghufron',
            'gender' => 'L',
            'alamat' => 'Stembayo',
            'kontak' => '087715308060',
            'email' => '20388@student.stembayo.sch.id',
            'nis' => '20388',
            'status_pkl' => 0,
        ],
        [
            'nama' => 'Ade Rafif Daneswara',
            'gender' => 'L',
            'alamat' => 'Stembayo',
            'kontak' => '08983688325',
            'email' => '20389@student.stembayo.sch.id',
            'nis' => '20389',
            'status_pkl' => 0,
        ],
        [
            'nama' => 'Ade Zaidan Althaf',
            'gender' => 'L',
            'alamat' => 'Stembayo',
            'kontak' => '087786760589',
            'email' => '20390@student.stembayo.sch.id',
            'nis' => '20390',
            'status_pkl' => 0,
        ],
        [
            'nama' => 'Adhwa Khalila Ramadhani',
            'gender' => 'P',
            'alamat' => 'Stembayo',
            'kontak' => '081229104926',
            'email' => '20391@student.stembayo.sch.id',
            'nis' => '20391',
            'status_pkl' => 0,
        ],
        [
            'nama' => 'Adnan Faris',
            'gender' => 'L',
            'alamat' => 'Stembayo',
            'kontak' => '088226929178',
            'email' => '20392@student.stembayo.sch.id',
            'nis' => '20392',
            'status_pkl' => 0,
        ],
        ]);
    }
}
