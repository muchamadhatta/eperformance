<?php

namespace App\Models\Setjen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoAlbum extends Model
{
    use HasFactory;

    protected $connection = 'db_revamp_dpr';
    protected $table = 'foto_album';

    protected $fillable = [
        'id_website',
        'id_bidang',
        'tanggal',
        'judul',
        'deskripsi',
        'status',
        'created_by',
        'updated_by',
        'thumbnail_name',
        'id_output',
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
