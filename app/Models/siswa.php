<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa'; // Nama tabel di database

    // Kolom yang bisa diisi massal
    protected $fillable = ['nama', 'nis', 'gender', 'alamat', 'kontak', 'email', 'foto', 'status_pkl'];

    // Relasi ke tabel PKL
    public function pkl()
    {
        return $this->hasMany(PKL::class);
    }
}
