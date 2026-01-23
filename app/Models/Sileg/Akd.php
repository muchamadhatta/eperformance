<?php

namespace App\Models\Sileg;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akd extends Model
{
    use HasFactory;

    protected $connection = 'db_minangwan';
    protected $table = 'akd';

    protected $fillable = [
        'akd',
        'akd_en',
        'singkatan',
        'akd_singkat',
        'id_bidang_pimpinan',
        'id_bidang_jdih',
        'email',
        'id_satker',
        'id_satker2',
        'parent',
        'urutan',
        'status',
        'user_input',
        'tanggal_input',
        'user_update',
        'tanggal_update',
        'telephone',
        'whatsapp',
        'sekretariat',
        'icon',
        'is_show',
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
