<?php

namespace Modules\MagangPustekinfo\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SekolahCustomModel extends Model
{
    use HasFactory;

    protected $connection = 'db_pustekinfo_internship';

    protected $table = 'sekolah_custom';

    protected $fillable = [
        'npsn',
        'name',
        'grade',
        'status',
        'address',
        'province_name',
        'regency_name',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
