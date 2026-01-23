<?php

namespace App\Models\Setjen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    use HasFactory;

    protected $connection = 'db_revamp_dpr';
    protected $table = 'pengajar';

    protected $fillable = [
        'id_website',
        'nama',
        'pekerjaan',
        'email',
        'kategori',
        'status',
        'pas_foto',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($audit) {
            // $audit->created_by = auth()->user()->pengguna;
            // $audit->created_by = 'pengguna';
            // $audit->status = 1;
        });

        static::updating(function ($audit) {
            // $audit->updated_by = auth()->user()->pengguna;
            // $audit->updated_by = 'pengguna';
        });
    }
}
