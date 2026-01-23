<?php

namespace App\Models\Setjen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AduanWbs extends Model
{
    use HasFactory;

    protected $connection = 'db_revamp_dpr';
    protected $table = 'aduan_wbs';

    protected $fillable = [
        'id_website',
        'nama',
        'topik',
        'unit_kerja',
        'aduan',
        'tanggal',
        'balasan',
        'status_balasan',
        'status',
        'status_aduan',
        'kodeunik',
        'dokumen',
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
