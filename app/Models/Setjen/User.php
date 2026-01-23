<?php

namespace App\Models\Setjen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $connection = 'db_revamp_dpr';
    protected $table = 'user';

    protected $fillable = [
        'id_pegawai',
        'id_website',
        'role',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'nama',
        'email',
        'jabatan',
        'lembaga',
        'foto',
        'deskripsi',
        'cv',
        'nip',
        'tim',
        'bidang_peminatan',
        'riwayat_pendidikan',
        'aktivitas',
    ];



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($audit) {
            // $audit->created_by = auth()->user()->pengguna;
            $audit->created_by = 'pengguna';
        });

        static::updating(function ($audit) {
            // $audit->updated_by = auth()->user()->pengguna;
            $audit->updated_by = 'pengguna';
        });
    }
}
