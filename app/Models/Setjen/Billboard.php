<?php

namespace App\Models\Setjen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billboard extends Model
{
    use HasFactory;

    protected $connection = 'db_revamp_dpr';
    protected $table = 'billboard';

    protected $fillable = [
        'id_website',
        'image_name',
        'image_type',
        'image_size',
        'judul',
        'sub_judul',
        'deskripsi',
        'link',
        'status',
        'kategori',
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
