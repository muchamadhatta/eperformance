<?php

namespace App\Models\Setjen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $connection = 'db_revamp_dpr';
    protected $table = 'agenda';

    protected $fillable = [
        'id_website',
        'id_bidang',
        'tanggal',
        'jam',
        'judul',
        'deskripsi',
        'tempat',
        'id_pimpinan_agenda',
        'id_tujuan_agenda',
        'kehadiran',
        'pendahuluan',
        'pokok_pembicaraan',
        'penutup',
        'id_pegawai',
        'nama_pegawai',
        'nip_pegawai',
        'jabatan_pegawai',
        'status',
        'created_by',
        'updated_by',
    ];



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($audit) {
            // $audit->created_by = auth()->user()->pengguna;
            $audit->created_by = 'pengguna';
            $audit->status = 1;
        });

        static::updating(function ($audit) {
            // $audit->updated_by = auth()->user()->pengguna;
            $audit->updated_by = 'pengguna';
        });
    }
}
