<?php

namespace App\Models\Setjen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    use HasFactory;

    protected $connection = 'db_revamp_dpr';
    protected $table = 'output';

    protected $fillable = [
        'id_website',
        'id_website_menu',
        'id_agenda_puu',
        'id_agenda_akn',
        'id_agenda_anggaran',
        'id_agenda_puslit',
        'id_agenda_puspanlakuu',
        'judul',
        'tag',
        'deskripsi',
        'tanggal',
        'lokasi',
        'image',
        'materi',
        'rekaman',
        'mulai',
        'selesai',
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
