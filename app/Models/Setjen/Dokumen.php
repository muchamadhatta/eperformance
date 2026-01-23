<?php

namespace App\Models\Setjen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $connection = 'db_revamp_dpr';
    protected $table = 'dokumen';

    protected $fillable = [
        'id_jenis_dokumen',
        'id_website',
        'id_website_menu',
        'tanggal',
        'judul',
        'deskripsi',
        'file_name',
        'file_size',
        'cover_file_name',
        'cover_file_size',
        'par1',
        'par2',
        'par3',
        'par4',
        'par5',
        'par6',
        'id_bidang',
        'created_by',
        'updated_by',
        'topik',
        'penulis',
        'preview',
        'tahapan',
        'lembaga',
        'latar_belakang',
        'hasil_kajian',
        'rekomendasi',
    ];



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($audit) {
            // $audit->created_by = auth()->user()->pengguna;
            $audit->created_by = 'pengguna';
        });

        static::updating(function ($audit) {
            // $audit->updated_by = auth()->user()->pengguna;
            $audit->updated_by = 'pengguna';
        });
    }
}
