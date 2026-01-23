<?php

namespace App\Models\Setjen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TujuanAgenda extends Model
{
    use HasFactory;

    protected $connection = 'db_revamp_dpr';
    protected $table = 'tujuan_agenda';

    protected $fillable = [
        'id_website',
        'tujuan_agenda',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deskripsi',
        'icon'
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
