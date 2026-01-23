<?php

namespace App\Models\Sileg;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembahasan_ruu extends Model {
    use HasFactory;

    protected $connection = 'db_sileg';
    protected $table = 'Pembahasan_ruu';

    protected $fillable = [
        'alur',
        'tahapan',
        'penjelasan',
        'ikon_alur',
        'ikon_tahapan',
        'warna_tahapan',
        'status',
        'user_input',
        'tanggal_input',
        'user_update',
        'tanggal_update',
        'step',
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
