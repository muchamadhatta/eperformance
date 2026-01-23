<?php

namespace App\Models\Setjen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteMenu extends Model
{
    use HasFactory;

    protected $connection = 'db_revamp_dpr';
    protected $table = 'website_menu';

    protected $fillable = [
        'id_website',
        'id_menu',
        'type',
        'param',
        'parent',
        'urutan',
        'status_detail',
        'status',
        'created_by',
        'updated_by',
        'x-folder',
        'url',
        'icon',
        'icon_color',
        'deskripsi',
        'id_website_menu',
        'sub_judul'
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
