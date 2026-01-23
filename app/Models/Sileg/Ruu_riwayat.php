<?php

namespace App\Models\Sileg;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruu_riwayat extends Model {
    use HasFactory;

    protected $connection = 'db_sileg';
    protected $table = 'Ruu_riwayat';

    protected $fillable = [
        'id_periode_prolegnas',
        'revisi',
        'id_ruu',
        'tahun',
        'judul_ruu_prioritas',
        'no_urut_prioritas',
        'pengusul_prioritas',
        'status',
        'user_input',
        'tanggal_input',
        'user_update',
        'tanggal_update',
    ];

    protected static function boot() {
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
