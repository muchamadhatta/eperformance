<?php

namespace App\Models\Sileg;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dpd extends Model
{
    use HasFactory;

    protected $connection = 'db_sileg';
    protected $table = 'dpd';

    protected $fillable = [
        'dpd',
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
