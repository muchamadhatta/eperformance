<?php

namespace App\Models\Sileg;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $connection = 'db_sileg';
    protected $table = 'feedback';

    protected $fillable = [
        'id_ruu',
        'nama',
        'email',
        'pesan',
        'file_name',
        'balasan',
        'id_akd1',
        'id_akd2',
        'id_akd3',
        'balasan1',
        'balasan2',
        'balasan3',
        'status_publikasi',
        'status',
        'user_input',
        'tanggal_input',
        'user_update',
        'tanggal_update',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($audit) {
            // $audit->user_input = auth()->user()->pengguna;
            $audit->tanggal_input = now();
        });

        static::updating(function ($audit) {
            // $audit->user_update = auth()->user()->pengguna;
            $audit->tanggal_update = now();
        });
    }


    public $timestamps = false;
}
