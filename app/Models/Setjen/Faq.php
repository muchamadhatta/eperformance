<?php

namespace App\Models\Setjen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $connection = 'db_revamp_dpr';
    protected $table = 'faq';

    protected $fillable = [
        'id_website',
        'nama_pengirim',
        'email_pengirim',
        'pertanyaan',
        'jawaban',
        'status_publikasi',
        'status',
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
