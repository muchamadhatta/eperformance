<?php

namespace App\Models\Setjen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $connection = 'db_revamp_dpr';
    protected $table = 'website';

    protected $fillable = [
        'nama_website',
        'url',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'template',
        'variant',
        'identitas',
        'sosmed',
        'banner',
        'section',
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
