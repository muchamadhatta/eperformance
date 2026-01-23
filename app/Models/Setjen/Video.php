<?php

namespace App\Models\Setjen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $connection = 'db_revamp_dpr';
    protected $table = 'video';

    protected $fillable = [
        'id_website',
        'id_album',
        'judul',
        'tanggal',
        'url',
        'deskripsi',
        'file_name',
        'file_size',
        'file_type',
        'thumbnail_name',
        'thumbnail_size',
        'thumbnail_type',
        'status',
        'created_at',
        'created_by',
        'updated_at',
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
