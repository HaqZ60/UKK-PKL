<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Siswa extends Model
{
    use HasFactory;
    use HasRoles;

    protected $guard_name = 'web';
    protected $table = 'siswa'; // Nama tabel di database

    // Kolom yang bisa diisi massal
    protected $fillable = ['nama', 'nis', 'gender', 'alamat', 'kontak', 'email', 'status_pkl', ];

    // Relasi ke tabel PKL
    public function pkl()
    {
        return $this->hasMany(PKL::class);
    }
}
