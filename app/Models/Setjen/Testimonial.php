<?php

namespace App\Models\Setjen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $connection = 'db_revamp_dpr';
    protected $table = 'testimonial';

    protected $fillable = [
        'id_website',
        'nama',
        'pekerjaan',
        'judul',
        'testimoni',
        'pas_foto',
        'status',
        'created_at',
        'updated_at',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($audit) {
            // $audit->created_by = auth()->user()->pengguna;
            // $audit->created_by = 'pengguna';
            $audit->status = 1;
        });

        static::updating(function ($audit) {
            // $audit->updated_by = auth()->user()->pengguna;
            // $audit->updated_by = 'pengguna';
        });
    }
}
