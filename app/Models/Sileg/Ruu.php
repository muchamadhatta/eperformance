<?php

namespace App\Models\Sileg;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruu extends Model
{
    use HasFactory;

    protected $connection = 'db_sileg';
    protected $table = 'ruu';

    protected $fillable = [
        'judul_ruu',
        'pengusul',
        'tanggal_pengusulan',
        'id_pembahasan_ruu',
        'id_akd',
        'id_satker',
        'keterangan',
        'email',
        'no_urut_longlist',
        'no_urut_prioritas',
        'riwayat_longlist',
        'id_kumulatif',
        'posisi_ruu_sebelum',
        'status_ruu',
        'status',
        'user_input',
        'tanggal_input',
        'user_update',
        'tanggal_update',
        'icon',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($audit) {
            // $audit->user_input = auth()->user()->pengguna;
            $audit->tanggal_input = now();
        });

        static::updating(function ($audit) {
            // $audit->user_update = auth()->user()->pengguna;
            $audit->tanggal_update = now();
        });
    }


    public $timestamps = false;
}
