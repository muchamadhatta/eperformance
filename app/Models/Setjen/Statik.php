<?php

namespace App\Models\Setjen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statik extends Model
{
    use HasFactory;

    protected $connection = 'db_revamp_dpr';
    protected $table = 'statik';

    protected $fillable = [
        'id_website',
        'id_menu',
        'parent',
        'judul',
        'judul_tampil',
        'kategori',
        'statik_id',
        'statik_en',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'id_website_menu',
        'thumbnail',
        'icon',
        'sub_judul',
        'penulis',
        'url',
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
