<?php

namespace App\Models\Sileg;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruu_deskripsi_konsepsi extends Model {
    use HasFactory;

    protected $connection = 'db_sileg';
    protected $table = 'Ruu_deskripsi_konsepsi';

    protected $fillable = [
        'id_ruu',
        'indeks',
        'tanggal',
        'judul',
        'pengusul',
        'latar_belakang',
        'sasaran',
        'jangkauan',
        'dasar_pembentukan',
        'sejarah_ruu',
        'file_name',
        'file_type',
        'file_size',
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
