<?php

namespace Modules\MagangPustekinfo\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SekolahModel extends Model
{
    use HasFactory;

    protected $connection = 'db_pustekinfo_internship';

    protected $table = 'sekolah';

    protected $guarded = [];

    public $timestamps = false;

    protected $casts = [
        'last_synced_at' => 'datetime',
    ];
}
